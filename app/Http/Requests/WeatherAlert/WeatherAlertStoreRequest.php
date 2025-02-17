<?php
namespace App\Http\Requests\WeatherAlert;

use App\DTO\WeatherAlert\WeatherAlertStoreRequestData;
use Illuminate\Foundation\Http\FormRequest;

class WeatherAlertStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'city' => 'required|string',
            'precipitation_threshold' => 'required|numeric',
            'uv_threshold' => 'required|numeric',
            'user_id' => 'nullable|exists:users,id',
        ];
    }

    public function dto(): WeatherAlertStoreRequestData
    {
        return new WeatherAlertStoreRequestData(
            $this->input('city'),
            $this->input('precipitation_threshold'),
            $this->input('uv_threshold'),
            $this->input('user_id') ?? auth()->id(),
        );
    }
}
