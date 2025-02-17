<?php

namespace App\Repositories;

use App\Models\WeatherAlert;

class WeatherAlertRepository
{

    public function create(array $data): WeatherAlert
    {
        return WeatherAlert::query()->create($data);
    }
}
