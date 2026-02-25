<?php

// Developed with the assistance of Claude Code (claude.ai)

namespace Grav\Plugin;

use Grav\Common\Plugin;

class HeliosCourseHubPlugin extends Plugin
{
    /** @var bool Whether the Helios theme is missing or inactive */
    protected $themeMissing = false;

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
                "Helios Grav Premium theme required. Enter your Helios and SVG Icons license keys, then install and activate the theme.",
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
        array_unshift($this->grav['twig']->twig_paths, __DIR__ . '/templates');
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
        $twig = $this->grav['twig'];
        $twig->twig_vars['github_server'] = $githubServer;

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
                return ($page->header()->visible ?? null) !== false;
            }));

            $versionInfo['versions'] = $filteredVersions;
            $versionInfo['count'] = count($filteredVersions);
            $twig->twig_vars['helios_version_info'] = $versionInfo;
        }
    }
}
