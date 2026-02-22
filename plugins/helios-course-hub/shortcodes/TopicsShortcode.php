<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class TopicsShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('topics', function(ShortcodeInterface $sc) {
            $content = $sc->getContent();

            // Find single-letter h2 headings (content is already rendered as HTML)
            preg_match_all('/<h2[^>]*>\s*([A-Z])\s*<\/h2>/i', $content, $matches);
            $active = array_unique(array_map('strtoupper', $matches[1]));

            // Build index showing all A-Z; letters with entries are links, others are plain text
            $allLetters = range('A', 'Z');
            $indexItems = array_map(function($letter) use ($active) {
                if (in_array($letter, $active)) {
                    return '<a href="#' . strtolower($letter) . '">' . $letter . '</a>';
                }
                return '<span class="topics-index-inactive">' . $letter . '</span>';
            }, $allLetters);
            $index = '<div class="topics-index">' . implode(' | ', $indexItems) . '</div>';

            // Replace single-letter h2 headings with styled letter divs
            $body = preg_replace_callback(
                '/<h2[^>]*>\s*([A-Z])\s*<\/h2>/i',
                function($m) {
                    $letter = strtoupper($m[1]);
                    return '<div class="topics-letter" id="' . strtolower($letter) . '">' . $letter . '</div>';
                },
                $content
            );

            return '<div class="topics-section">' . $index . $body . '</div>';
        });
    }
}
