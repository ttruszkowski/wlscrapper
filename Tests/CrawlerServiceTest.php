<?php

namespace App\Tests;

use App\Services\CrawlerService;
use Goutte\Client;
use PHPUnit\Framework\TestCase;

class CrawlerServiceTest extends TestCase
{

    public function testCreateClientInCrawlerService(): void
    {
        $crawlerService = new CrawlerService();
        $this->assertInstanceOf(Client::class, $crawlerService->getClient());
    }

}