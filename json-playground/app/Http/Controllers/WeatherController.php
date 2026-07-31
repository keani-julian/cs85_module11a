<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class WeatherController extends Controller
{
    public function index()
    {
        $json = Storage::get('weather.json');
        $weatherData = json_decode($json, true);

        // Sort the forecast alphabetically by day name.
        usort($weatherData, fn ($a, $b) => $a['day'] <=> $b['day']);

        return view('weather.index', ['weather' => $weatherData]);
    }
}
