<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class EmbedlyShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('embedly', function(ShortcodeInterface $sc) {

            // Get shortcode content and parameters
            $embedlycardurl = $sc->getParameter('url', $sc->getBbCode()) ?: $sc->getContent();

            if ($embedlycardurl) {
                return '<a class="embedly-card" data-card-controls="0" data-card-align="left" href="' . htmlspecialchars($embedlycardurl, ENT_QUOTES, 'UTF-8') . '"></a>';
            }

        });
    }
}
