<?php
namespace App\Http\Resources;

use App\Models\WeatherAlert;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin WeatherAlert
 */
class WeatherAlertResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'city' => $this->city,
            'precipitation_threshold' => $this->precipitation_threshold,
            'uv_threshold' => $this->uv_threshold,
            'user_id' => $this->user->name,
        ];
    }
}
