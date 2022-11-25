<?php

namespace App\Services;

abstract class JsonEncoderDecoderService
{
    public static function encode(array $dataArray): string
    {
        return json_encode($dataArray);
    }

    public static  function decode(string $jsonString): mixed
    {
        return json_decode($jsonString);
    }
}