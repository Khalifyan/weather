<?php
namespace Database\Factories;

use App\Models\WeatherAlert;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeatherAlertFactory extends Factory
{
    protected $model = WeatherAlert::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create()->id,
            'city' => $this->faker->city,
            'precipitation_threshold' => $this->faker->randomFloat(2, 5, 20),
            'uv_threshold' => $this->faker->randomFloat(2, 3, 10),
        ];
    }
}
