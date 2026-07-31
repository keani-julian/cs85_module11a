<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WeatherController extends Controller
{
    public function index()
    {
        $json = Storage::get('weather.json');
        $weatherData = json_decode($json, true);

        return view('weather.index', ['weather' => $weatherData]);
    }
}
