<?php

namespace App\Services;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class CrawlerService
{
    private Crawler $crawler;
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function makeRequest(string $url): void
    {
        $this->crawler = $this->client->request('GET', $url);
    }

    public function filterProducts(): array
    {
        $products = $this->crawler->filter('.row-subscriptions > div')->each(function($item) {
            return $this->generateProductItem($item);
        });

        usort($products, function($a, $b) {
            return $a['price'] < $b['price'];
        });

        return $products;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    private function generateProductItem(Crawler $node): array
    {
        return [
            'title' => $node->filter('.header h3')->text(),
            'description' => $node->filter('.package-description')->text(),
            'price' => $this->parsePrice($node->filter('.package-price')),
            'discount' => $this->parseDiscount($node->filter('.package-price'))
        ];
    }

    private function parsePrice(Crawler $node): float
    {
        $text = $node->filter('.price-big')->text();
        $parsedPrice = floatval(str_replace('£', '', $text));

        if (str_contains($node->text(), 'Per Month')) {
            $parsedPrice *= 12;
        }

        return $parsedPrice;
    }

    private function parseDiscount(Crawler $node): float
    {
        if (str_contains($node->text(), 'Per Month')) {
            return 0;
        }

        return (float) str_replace('£', '', $this->stringBeforeAfter($node->text()));
    }

    private function stringBeforeAfter(string $str): string
    {
        if (preg_match("/Save (.*?) on/", $str, $match) == 1) {
            return $match[1];
        }

        return 0;
    }

}