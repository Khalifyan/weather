<?php
namespace Tests\Feature;

use App\Models\User;
use App\Models\WeatherAlert;
use App\Notifications\WeatherAlertNotification;
use App\Services\WeatherAlertService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class WeatherAlertTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanCreateAlert()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->postJson('/api/alerts', [
            'city' => 'New York',
            'precipitation_threshold' => 5,
            'uv_threshold' => 6,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('weather_alerts', ['city' => 'New York']);
    }

    public function testWeatherAlertNotificationIsSent()
    {
        Notification::fake();
        Http::fake([
            'https://api.weather.com/v1/weather*' => Http::response([
                'precipitation' => 12,
                'uv_index' => 9
            ], 200)
        ]);

        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $alert = WeatherAlert::factory()->create([
            'user_id' => $user->id,
            'city' => 'New York',
            'precipitation_threshold' => 5,
            'uv_threshold' => 6,
        ]);
        app(WeatherAlertService::class)->checkWeatherAndNotify();

        Notification::assertSentTo($user, WeatherAlertNotification::class);
    }
}
