<?php

/**
 * Represents a link card with a title, description, and URL.
 */
class LinkCard
{
    private string $title;
    private string $description;
    private string $url;
    private string $domain;

    /**
     * @param string $title The card title.
     * @param string $description A brief description.
     * @param string $url The target URL.
     */
    public function __construct(string $title, string $description, string $url)
    {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;

        // Extract domain from URL for display purposes
        $parsedUrl = parse_url($url);
        $this->domain = $parsedUrl['host'] ?? 'example.com';
    }

    /**
     * Render the link card as an HTML string.
     * All dynamic content is escaped to prevent XSS.
     *
     * @return string The HTML representation.
     */
    public function render(): string
    {
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDescription = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDomain = htmlspecialchars($this->domain, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return <<<HTML
<div class="link-card">
    <a href="{$escapedUrl}" target="_blank" rel="noopener noreferrer">
        <div class="link-card-title">{$escapedTitle}</div>
        <div class="link-card-description">{$escapedDescription}</div>
        <div class="link-card-domain">{$escapedDomain}</div>
    </a>
</div>
HTML;
    }
}

/**
 * Build a default set of link cards for demonstration.
 *
 * @return array List of LinkCard objects.
 */
function createDefaultLinkCards(): array
{
    return [
        new LinkCard(
            '九游官方门户',
            '九游游戏中心，发现更多精彩手游与福利。',
            'https://portal-main-9you.com'
        ),
        new LinkCard(
            '九游社区',
            '玩家聚集地，最新攻略与活动。',
            'https://bbs.9you.com'
        ),
        new LinkCard(
            '九游攻略站',
            '深度游戏攻略，助你轻松过关。',
            'https://gl.9you.com'
        ),
    ];
}

/**
 * Generate HTML for a list of link cards.
 *
 * @param array $cards Array of LinkCard objects.
 * @return string The combined HTML string.
 */
function renderLinkCards(array $cards): string
{
    $html = '<div class="link-card-list">';
    foreach ($cards as $card) {
        $html .= $card->render();
    }
    $html .= '</div>';
    return $html;
}

// --- Example usage (remove if including in a larger project) ---
// $cards = createDefaultLinkCards();
// echo renderLinkCards($cards);

// --- Simple demonstration (safe, no side effects) ---
// Uncomment the following lines to test:
// header('Content-Type: text/html; charset=utf-8');
// echo '<!DOCTYPE html><html><head><style>
// .link-card {
//     border: 1px solid #ccc;
//     border-radius: 8px;
//     padding: 16px;
//     margin: 8px 0;
//     max-width: 400px;
//     background: #f9f9f9;
// }
// .link-card a {
//     text-decoration: none;
//     color: inherit;
// }
// .link-card-title {
//     font-size: 18px;
//     font-weight: bold;
//     margin-bottom: 8px;
// }
// .link-card-description {
//     font-size: 14px;
//     color: #555;
//     margin-bottom: 4px;
// }
// .link-card-domain {
//     font-size: 12px;
//     color: #999;
// }
// </style></head><body>';
// $cards = createDefaultLinkCards();
// echo renderLinkCards($cards);
// echo '</body></html>';