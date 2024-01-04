<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherServiceController extends Controller
{
    public function index()
    {
        return view('weather.weatherServiceForm');
    }

    public function response(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        return view('weather.weatherServiceResponse')->with(['latitude' => $latitude, 'longitude' => $longitude]);
    }
}
