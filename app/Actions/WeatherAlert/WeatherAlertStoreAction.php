<?php

namespace App\Actions\WeatherAlert;

use App\DTO\WeatherAlert\WeatherAlertStoreRequestData;
use App\Models\WeatherAlert;
use App\Repositories\WeatherAlertRepository;

readonly class WeatherAlertStoreAction
{
    public function __construct(
        private WeatherAlertRepository $weatherAlertRepository,
    )
    {
    }

    public function execute(WeatherAlertStoreRequestData $data): WeatherAlert
    {
        $requestData = [
            'city' => $data->city,
            'precipitation_threshold' => $data->precipitationThreshold,
            'uv_threshold' => $data->uvThreshold,
            'user_id' => $data->user_id ?? auth()->id(),
        ];

        return $this->weatherAlertRepository->create($requestData);
    }
}
