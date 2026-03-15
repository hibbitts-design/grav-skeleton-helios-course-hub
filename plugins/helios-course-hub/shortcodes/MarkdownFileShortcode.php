<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;
use Grav\Common\Utils;

class MarkdownFileShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('markdownfile', function(ShortcodeInterface $sc) {

            // Get shortcode content and parameters
            $url = $sc->getParameter('url', $sc->getBbCode()) ?: $sc->getContent();

            if (!$url) {
                return '';
            }

            // Allow http and https only — blocks file://, ftp://, etc.
            $scheme = strtolower(parse_url($url, PHP_URL_SCHEME));
            if (!in_array($scheme, ['http', 'https'], true)) {
                return '<p>Invalid URL scheme.</p>';
            }

            // Resolve host to IP and block private/reserved ranges (SSRF mitigation).
            // Note: there is a residual DNS-rebinding risk between this check and the
            // cURL fetch below. Acceptable for a trusted-author course hub context.
            $host = parse_url($url, PHP_URL_HOST);
            $ip   = gethostbyname($host);
            if ($ip === $host) {
                return '<p>Unable to resolve host.</p>';
            }
            if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                return '<p>URL resolves to a disallowed address.</p>';
            }

            // Fetch via cURL with redirects disabled to prevent redirect-based SSRF
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => false,
                CURLOPT_TIMEOUT        => 10,
            ]);
            $file       = curl_exec($ch);
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($file === false || $statusCode !== 200) {
                return '<p>Unable to retrieve file with URL ' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '</p>';
            }

            // Strip front matter
            $file = preg_replace('/^---[\s\S]*?---\s*/m', '', $file);

            // Strip raw HTML from fetched content before Markdown processing to prevent XSS.
            // Trade-off: intentional inline HTML in the remote file will also be removed.
            $file = strip_tags($file);

            return Utils::processMarkdown($file);
        });
    }
}
