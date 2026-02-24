<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class PDFShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('pdf', function(ShortcodeInterface $sc) {

            // Get shortcode content and parameters
            $pdfurl = $sc->getParameter('url', $sc->getBbCode()) ?: $sc->getContent();
            $ratio  = $sc->getParameter('ratio', '16:9');

            // Map ratio parameter to CSS modifier class; default is 16:9
            if ($ratio === '4:3') {
                $ratioClass = ' responsive-container--4x3';
            } elseif ($ratio === 'portrait') {
                $ratioClass = ' responsive-container--portrait';
            } else {
                $ratioClass = '';
            }

            if ($pdfurl) {
                $output = '<div class="responsive-container' . $ratioClass . '"><iframe src="https://docs.google.com/gview?url=' . htmlspecialchars($pdfurl, ENT_QUOTES, 'UTF-8') . '&amp;embedded=true"></iframe></div>';

                return $output;
            }

        });
    }
}
