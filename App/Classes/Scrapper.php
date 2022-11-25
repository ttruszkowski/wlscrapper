<?php

namespace App\Classes;

use App\Services\ConfigService;
use App\Services\CrawlerService;


class Scrapper
{
    protected ConfigService $configService;
    protected CrawlerService $crawlerService;

    protected string $webPageUrl;
    protected array $data;

    public function __construct(ConfigService $configService, CrawlerService $crawlerService)
    {
        $this->configService = $configService;
        $this->crawlerService = $crawlerService;
        $this->init();
        $this->scrap();
    }

    public function getData(): array
    {
        return $this->data;
    }

    protected function init(): void
    {
        $this->webPageUrl = $this->configService->getConfig('web_page_url');
    }

    protected function scrap(): void
    {
        $this->crawlerService->makeRequest($this->webPageUrl);
        $this->data = $this->crawlerService->filterProducts();
    }

}