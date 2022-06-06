<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;

class WeatherController extends Controller
{
    public function Weather()
    {
        $apiKey = env('API_KEY');
        $lat = 58.254951;
        $lon = 22.491898;
        if (Cache::has("weather")) {
            $data = Cache::get('weather');
        } else {
            $response = Http::get("https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&units=metric&appid=" . config("services.weather.key"));
            Cache::put("weather", array("name" => $response["name"], "sys" => $response["sys"], "wind" => $response["wind"], "weather" => $response["weather"], "main" => $response["main"]), 150);
            $data = Cache::get("weather");
        }
        return Inertia::render("Weather", [
            'data' => $data
        ]);
    }
}
