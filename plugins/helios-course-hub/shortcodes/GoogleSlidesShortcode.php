<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class GoogleSlidesShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getRawHandlers()->add('googleslides', function(ShortcodeInterface $sc) {

            // Get shortcode content and parameters
            $googleslidesurl = $sc->getParameter('url', $sc->getBbCode()) ?: $sc->getContent();
            $ratio           = $sc->getParameter('ratio', '16:9');

            // Map ratio parameter to CSS modifier class; default is 16:9
            $ratioClass = ($ratio === '4:3') ? ' responsive-container--4x3' : '';

            if ($googleslidesurl) {
                $output = '<div class="responsive-container' . $ratioClass . '"><iframe src="' . $googleslidesurl . '" frameborder="0" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe></div>';

                return $output;
            }

        });
    }
}
