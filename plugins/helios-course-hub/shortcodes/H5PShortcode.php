<?php
namespace Grav\Plugin\Shortcodes;

use Grav\Common\Grav;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class H5PShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('h5p', function(ShortcodeInterface $sc) {

            // Get shortcode content and parameters
            $h5pid  = $sc->getParameter('id', $sc->getBbCode());
            $h5purl = $sc->getParameter('url', $sc->getBbCode()) ?: $sc->getContent();

            // H5P resizer script handles iframe sizing dynamically
            $resizer = '<script src="https://h5p.org/sites/all/modules/h5p/library/js/h5p-resizer.js" charset="UTF-8"></script>';

            if ($h5pid) {
                $config  = Grav::instance()['config'];
                $h5proot = $config->get('plugins.helios-course-hub.h5pembedrootpath');

                $embedurl = (strpos($h5proot, 'h5p.com') !== false)
                    ? $h5proot . $h5pid . '/embed'
                    : $h5proot . $h5pid;

                return '<p><iframe src="' . $embedurl . '" width="400" height="300" frameborder="0" allowfullscreen="allowfullscreen"></iframe>' . $resizer . '</p>';

            } elseif ($h5purl) {
                return '<p><iframe src="' . $h5purl . '" width="400" height="300" frameborder="0" allowfullscreen="allowfullscreen"></iframe>' . $resizer . '</p>';
            }

        });
    }
}
