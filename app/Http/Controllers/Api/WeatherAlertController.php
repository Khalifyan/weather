<?php
namespace App\Http\Controllers\Api;

use App\Actions\WeatherAlert\WeatherAlertStoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\WeatherAlert\WeatherAlertStoreRequest;
use App\Http\Resources\WeatherAlertResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class WeatherAlertController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return WeatherAlertResource::collection(Auth::user()->weatherAlerts);
    }
    public function store(WeatherAlertStoreAction $action, WeatherAlertStoreRequest $request): WeatherAlertResource
    {
        return new WeatherAlertResource($action->execute($request->dto()));
    }
}
