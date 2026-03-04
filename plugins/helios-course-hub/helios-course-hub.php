<?php

// Developed with the assistance of Claude Code (claude.ai)

namespace Grav\Plugin;

use Grav\Common\Plugin;

class HeliosCourseHubPlugin extends Plugin
{
    /** @var bool Whether the Helios theme is missing or inactive */
    protected $themeMissing = false;

    /** @var string|null Computed "Course | Page Title | Site Title" browser title */
    protected $browserTitle = null;

    /** @var string|null URL of favicon.* found in course root page media */
    protected $courseFaviconUrl = null;

    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
        ];
    }

    public function onPluginsInitialized()
    {
        // Check theme folder and active status directly, as admin may have switched to Quark
        $themeName = 'helios';
        $themePath = GRAV_ROOT . '/user/themes/' . $themeName;
        $themeActive = $this->config->get('system.pages.theme') === $themeName;

        if (!is_dir($themePath) || !$themeActive) {
            $this->config->set('system.pages.theme', 'quark');
            $this->themeMissing = true;
        }

        if ($this->isAdmin()) {
            $this->enable([
                'onPageInitialized' => ['onPageInitialized', 0],
                'onGetPageBlueprints' => ['onGetPageBlueprints', 0],
            ]);
            return;
        }

        $this->enable([
            'onThemeInitialized' => ['onThemeInitialized', -1000],
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
            'onTwigSiteVariables' => ['onTwigSiteVariables', -100],
            'onOutputGenerated'   => ['onOutputGenerated', 0],
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
        ]);
    }

    public function onPageInitialized()
    {
        $assets = $this->grav['assets'];
        $path = 'plugin://helios-course-hub/assets';

        $assets->addCss("$path/admin.css");
        $assets->addJs("$path/admin.js");

        if ($this->themeMissing) {
            $heliosLicense = \Grav\Common\GPM\Licenses::get('helios');
            $targetRoute = $heliosLicense ? '/admin/themes' : '/admin/license-manager';
            $currentRoute = $this->grav['uri']->path();
            $isLoggedIn = $this->grav['user']->authenticated ?? false;

            // Show banner on all admin pages; redirect to target only from /admin
            $this->grav['messages']->add(
                "Helios Grav Premium theme required. Enter your Helios and SVG Icons license keys, then install and activate the theme. (Helios Course Hub Plugin)",
                'warning'
            );

            if ($isLoggedIn && $currentRoute === '/admin') {
                $this->grav->redirect($targetRoute);
                return;
            }
        }
    }

    public function onGetPageBlueprints($event)
    {
        $types = $event->types;
        $types->scanBlueprints('plugin://helios-course-hub/blueprints');
    }

    public function onThemeInitialized()
    {
        // Override version switcher labels using active language translations
        $lang       = $this->grav['language'];
        $activeLang = $lang->getLanguage() ?: 'en';
        $courseLabel = $lang->translate('PLUGIN_HELIOS_COURSE_HUB.COURSE_LABEL');
        $latestLabel = $lang->translate('PLUGIN_HELIOS_COURSE_HUB.COURSE_LATEST_LABEL');

        $this->grav['languages']->mergeRecursive([
            $activeLang => [
                'THEME_HELIOS' => [
                    'VERSION'        => $courseLabel,
                    'VERSION_LATEST' => $latestLabel,
                ],
            ],
        ]);
    }

    public function onTwigTemplatePaths()
    {
        $twig = $this->grav['twig'];
        array_unshift($twig->twig_paths, __DIR__ . '/templates');
    }

    public function onShortcodeHandlers()
    {
        $shortcodes = $this->grav['shortcode'];
        $dir = __DIR__ . '/shortcodes';

        // Register only .php files to avoid processing .DS_Store and similar
        foreach (new \DirectoryIterator($dir) as $file) {
            if ($file->isDot() || $file->isDir() || $file->getExtension() !== 'php') {
                continue;
            }
            $shortcodes->registerShortcode($file->getFilename(), $dir);
        }
    }

    public function onTwigSiteVariables()
    {
        $assets = $this->grav['assets'];
        $path = 'plugin://helios-course-hub/assets';

        $assets->addCss("$path/helios.css");
        $assets->addJs("$path/helios.js", ['group' => 'bottom', 'loading' => 'defer']);

        $githubServer = $this->config->get('plugins.helios-course-hub.github_server', 'github.com');
        $showSiteIcon = $this->config->get('plugins.helios-course-hub.show_site_icon', true);
        $siteIcon = $this->config->get('plugins.helios-course-hub.site_icon', '');
        // Use card_icon from the course-list page as the default course label icon
        $courseListPage = null;
        foreach ($this->grav['pages']->instances() as $p) {
            if ($p->template() === 'course-list') {
                $courseListPage = $p;
                break;
            }
        }
        $courseLabelIcon = ($courseListPage && ($courseListPage->header()->card_icon ?? false))
            ? $courseListPage->header()->card_icon
            : '';
        $twig = $this->grav['twig'];
        $twig->twig_vars['github_server'] = $githubServer;
        $twig->twig_vars['show_site_icon'] = $showSiteIcon;
        $twig->twig_vars['site_icon'] = $siteIcon;
        $twig->twig_vars['course_label_icon'] = $courseLabelIcon;
        $twig->twig_vars['helios_base_simple'] = $this->themeMissing
            ? 'partials/base.html.twig'
            : 'partials/base-simple.html.twig';

        // Default logo URL to site root; overridden below when only one course is active
        $twig->twig_vars['logo_url'] = $this->grav['base_url'] ?: '/';

        // Filter helios_version_info to respect 'visible: false' in course frontmatter.
        // Runs at priority -100 to ensure the theme has already populated this variable.
        if (isset($twig->twig_vars['helios_version_info'])) {
            $pages = $this->grav['pages'];
            $versionInfo = $twig->twig_vars['helios_version_info'];

            $filteredVersions = array_values(array_filter($versionInfo['versions'], function ($version) use ($pages) {
                $versionId = is_array($version) ? ($version['id'] ?? null) : ($version->id ?? null);
                if (!$versionId) {
                    return true;
                }
                $page = $pages->find('/' . $versionId);
                if (!$page) {
                    return true;
                }
                return $page->published();
            }));

            // Enrich versions with icon from page frontmatter
            $enrichedVersions = [];
            foreach ($filteredVersions as $version) {
                $versionId = is_array($version) ? ($version['id'] ?? null) : ($version->id ?? null);
                if ($versionId) {
                    $versionPage = $pages->find('/' . $versionId);
                    if ($versionPage && ($versionPage->header()->icon ?? false)) {
                        $version['icon'] = $versionPage->header()->icon;
                    }
                }
                $enrichedVersions[] = $version;
            }
            $filteredVersions = $enrichedVersions;

            $versionInfo['versions'] = $filteredVersions;
            $versionInfo['count'] = count($filteredVersions);
            $twig->twig_vars['helios_version_info'] = $versionInfo;

            // Set course_label_url to the first child page of the current course version
            $twig->twig_vars['course_label_url'] = null;
            foreach ($filteredVersions as $version) {
                $isCurrent = is_array($version) ? ($version['is_current'] ?? false) : ($version->is_current ?? false);
                if ($isCurrent) {
                    $versionId = is_array($version) ? ($version['id'] ?? null) : ($version->id ?? null);
                    if ($versionId) {
                        $versionPage = $pages->find('/' . $versionId);
                        if ($versionPage) {
                            $firstChild = $versionPage->children()->first();
                            if ($firstChild) {
                                $twig->twig_vars['course_label_url'] = $firstChild->url();
                            }
                            // Check for favicon.* in course root page media (convention-based)
                            // Strip any Admin-added numeric prefix (e.g. "130_favicon.png" → "favicon.png")
                            foreach ($versionPage->media()->all() as $filename => $medium) {
                                $basename = preg_replace('/^\d+_/', '', $filename);
                                if (strncmp($basename, 'favicon.', 8) === 0) {
                                    $this->courseFaviconUrl = $medium->url();
                                    break;
                                }
                            }
                        }
                    }
                    break;
                }
            }

            // When logo_link_target is 'single_course' and only one course is active, point the logo link to its first child page
            $logoLinkTarget = $this->config->get('plugins.helios-course-hub.logo_link_target', 'courses_list');
            if ($logoLinkTarget === 'single_course' && $versionInfo['count'] === 1) {
                $singleVersion = $versionInfo['versions'][0] ?? null;
                $versionId = is_array($singleVersion) ? ($singleVersion['id'] ?? null) : ($singleVersion->id ?? null);
                if ($versionId) {
                    $versionPage = $pages->find('/' . $versionId);
                    if ($versionPage) {
                        $firstChild = $versionPage->children()->first();
                        if ($firstChild) {
                            $twig->twig_vars['logo_url'] = $firstChild->url();
                        }
                    }
                }
            }

            // Build "Course | Page Title | Site Title" browser title when a current version exists
            $page = $this->grav['page'];
            $pageTitle = $page ? $page->title() : '';
            $siteTitle = $this->grav['config']->get('site.title', '');

            $courseLabel = null;
            foreach ($filteredVersions as $version) {
                $isCurrent = is_array($version) ? ($version['is_current'] ?? false) : ($version->is_current ?? false);
                if ($isCurrent) {
                    $courseLabel = is_array($version) ? ($version['label'] ?? null) : ($version->label ?? null);
                    break;
                }
            }

            if ($courseLabel && $pageTitle && $siteTitle) {
                $this->browserTitle = $pageTitle . ' | ' . $courseLabel . ' | ' . $siteTitle;
            }
        }
    }

    public function onOutputGenerated($event)
    {
        if ($this->browserTitle !== null) {
            $event['output'] = preg_replace(
                '~<title>[^<]*</title>~',
                '<title>' . htmlspecialchars($this->browserTitle, ENT_QUOTES, 'UTF-8') . '</title>',
                $event['output'],
                1
            );
        }

        if ($this->courseFaviconUrl !== null) {
            $faviconTag = '<link rel="icon" href="' . htmlspecialchars($this->courseFaviconUrl, ENT_QUOTES, 'UTF-8') . '">';
            $event['output'] = preg_replace(
                '~<link rel="icon"[^>]*>~',
                $faviconTag,
                $event['output'],
                1
            );
        }
    }
}
