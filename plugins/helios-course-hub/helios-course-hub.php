<?php

// Developed with the assistance of Claude Code (claude.ai)

namespace Grav\Plugin;

use Grav\Common\Plugin;

class HeliosCourseHubPlugin extends Plugin
{
    /** @var bool Whether the configured theme is missing */
    protected $themeMissing = false;

    /** @var string The name of the missing theme */
    protected $missingThemeName = '';

    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
        ];
    }

    public function onPluginsInitialized()
    {
        // If the configured theme is missing, fall back to Quark so
        // Grav can still render pages and the Admin panel remains accessible
        $themeName = $this->config->get('system.pages.theme');
        $themePath = GRAV_ROOT . '/user/themes/' . $themeName;

        if (!is_dir($themePath)) {
            $this->config->set('system.pages.theme', 'quark');
            $this->themeMissing = true;
            $this->missingThemeName = $themeName;

            // Redirect frontend requests to the Admin Themes page
            if (!$this->isAdmin()) {
                $adminRoute = $this->config->get('plugins.admin.route', '/admin');
                $this->grav->redirect($adminRoute . '/themes');
                return;
            }
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
            'onTwigSiteVariables' => ['onTwigSiteVariables', 0],
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
        ]);
    }

    public function onPageInitialized()
    {
        $assets = $this->grav['assets'];
        $path = 'plugin://helios-course-hub/assets';

        $assets->addCss("$path/admin.css");
        $assets->addJs("$path/admin.js");

        // Show a banner prompting the user to install the missing theme
        if ($this->themeMissing) {
            $this->grav['messages']->add(
                "The Helios Grav Premium theme is required. Please enter your Helios (and included SVG Icons) licenses and then install and activate Helios.",
                'warning'
            );
        }
    }

    public function onGetPageBlueprints($event)
    {
        $types = $event->types;
        $types->scanBlueprints('plugin://helios-course-hub/blueprints');
    }

    public function onThemeInitialized()
    {
        // Override version switcher labels for course hub context,
        // using the active language's translated values so additional
        // languages are supported by adding entries to languages.yaml
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
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    public function onShortcodeHandlers()
    {
        $shortcodes = $this->grav['shortcode'];
        $dir = __DIR__ . '/shortcodes';

        // Register only .php files to avoid processing .DS_Store
        // or other non-PHP files that macOS may create
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
    }
}
