<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class WebScraperService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function scrapeWebsite(string $url): array
    {
        try {
            if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
                $url = "https://" . $url;
            }

            $response = $this->client->get($url);
            $html = $response->getBody()->getContents();

            // Parse the HTML
            $doc = new \DOMDocument();
            @$doc->loadHTML($html);

            // Get favicon
            $favicon = '';
            $links = $doc->getElementsByTagName('link');
            foreach ($links as $link) {
                if ($link->getAttribute('rel') == 'icon' || $link->getAttribute('rel') == 'shortcut icon') {
                    $favicon = $link->getAttribute('href');
                    break;
                }
            }

            // Get title
            $title = '';
            $titleTags = $doc->getElementsByTagName('title');
            if ($titleTags->length > 0) {
                $title = $titleTags->item(0)->nodeValue;
            }

            return [
                'title' => $title,
                'favicon' => $this->resolveUrl($url, $favicon),
                'url' => $url
            ];
        } catch (GuzzleException $e) {
            return [
                'title' => '',
                'favicon' => '',
                'url' => $url
            ];
        }
    }

    private function resolveUrl($base, $rel)
    {
        if (parse_url($rel, PHP_URL_SCHEME) != '') return $rel;
        if ($rel[0] == '/') return parse_url($base, PHP_URL_SCHEME) . '://' . parse_url($base, PHP_URL_HOST) . $rel;
        return dirname($base) . '/' . $rel;
    }
}
