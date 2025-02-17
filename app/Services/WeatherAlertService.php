<?php
namespace App\Services;

use App\Models\User;
use App\Notifications\WeatherAlertNotification;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;

class WeatherAlertService
{
    private string $weatherApi = 'https://api.weather.com/v1/weather';
    /**
     * @throws Exception
     */
    public function checkWeatherAndNotify(): void
    {
        $users = User::with('weatherAlerts')->get();
        foreach ($users as $user) {
            foreach ($user->weatherAlerts as $alert) {
                $weatherData = $this->fetchWeather($alert->city);
                if ($this->shouldNotify($alert, $weatherData)) {
                    Notification::send($user, new WeatherAlertNotification($weatherData));
                }
            }
        }
    }

    /**
     * @throws Exception
     */
    protected function fetchWeather(string $city): array
    {
        $response = Http::get($this->weatherApi, ['city' => $city]);

        if ($response->failed()) {
            throw new Exception("Failed to fetch weather data for {$city}");
        }

        $data = $response->json();

        if (!is_array($data) || !isset($data['precipitation']) || !isset($data['uv_index'])) {
            throw new Exception("Invalid response format from weather API for {$city}");
        }

        return $data;
    }
    protected function shouldNotify($alert, array $weatherData): bool
    {
        return $weatherData['precipitation'] > $alert->precipitation_threshold ||
            $weatherData['uv_index'] > $alert->uv_threshold;
    }
}
