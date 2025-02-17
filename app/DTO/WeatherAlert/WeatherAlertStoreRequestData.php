<?php
namespace App\DTO\WeatherAlert;

class WeatherAlertStoreRequestData
{
    public function __construct(
        public string $city,
        public float $precipitationThreshold,
        public float $uvThreshold,
        public ?int $userId,
    )
    {
    }
}
