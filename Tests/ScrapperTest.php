<?php

namespace App\Tests;

use App\Classes\Scrapper;
use App\Services\ConfigService;
use App\Services\CrawlerService;
use PHPUnit\Framework\TestCase;

class ScrapperTest extends TestCase
{

    public function testGetDataCount(): void
    {
        $productsCountOnPage = 6;
        $configService = new ConfigService();
        $crawlerService = new CrawlerService();
        $scrapper = new Scrapper($configService, $crawlerService);
        $this->assertEquals($productsCountOnPage, count($scrapper->getData()));
    }

}