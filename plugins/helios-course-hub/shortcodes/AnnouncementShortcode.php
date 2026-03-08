<?php
namespace Grav\Plugin\Shortcodes;

use Grav\Common\Twig\Extension\GravExtension;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class AnnouncementShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('announcement', function(ShortcodeInterface $sc) {
            $content = $sc->getContent();

            if (!$content) {
                return '';
            }

            $validTypes = ['note', 'tip', 'important', 'warning', 'caution'];
            $type = strtolower($sc->getParameter('type', 'important'));
            if (!in_array($type, $validTypes)) {
                $type = 'important';
            }

            $title   = htmlspecialchars($sc->getParameter('title', 'Announcement'), ENT_QUOTES, 'UTF-8');
            $iconUri = 'plugin://github-markdown-alerts/assets/icons/octicon-' . $type . '.svg';
            $icon    = GravExtension::svgImageFunction($iconUri);

            $output  = '<div class="md-alert md-alert--' . $type . '" dir="auto">';
            $output .= '<p class="md-alert-title">' . ($icon ? $icon . ' ' : '') . $title . '</p>';
            $output .= '<div class="md-alert-body">' . $content . '</div>';
            $output .= '</div>';

            return $output;
        });
    }
}
