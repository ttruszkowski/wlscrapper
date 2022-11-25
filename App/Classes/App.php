<?php

namespace App\Classes;

use App\Services\JsonEncoderDecoderService;

class App
{
    protected $scrapper;

    public function __construct(Scrapper $scrapper)
    {
        $this->scrapper = $scrapper;
    }

    public function run(): string
    {
        $dataFromScrapper = $this->scrapper->getData();
        return JsonEncoderDecoderService::encode($dataFromScrapper);
    }

    protected function initScrapper(): void
    {
        $this->scrapper = new Scrapper();
    }

}