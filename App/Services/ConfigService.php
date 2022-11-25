<?php

namespace App\Services;

class ConfigService
{
    const CONFIG_FILE = __DIR__ . '/../Config/config.yml';
    private array $configValues;

    public function __construct()
    {
        $this->configValues = yaml_parse_file(self::CONFIG_FILE);
    }

    public function getConfig(string $key): mixed
    {
        return $this->configValues[$key];
    }
}