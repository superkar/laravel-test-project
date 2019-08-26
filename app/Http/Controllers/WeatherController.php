<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
    /**
     * Display current weather in Bryansk city.
     *
     * @return \Illuminate\Http\Response
     */    
    public function __invoke()
    {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://api.weather.yandex.ru/v1/forecast/?lat=53.243562&lon=34.363407&limit=0&hours=false&extra=true',
            CURLOPT_HTTPGET => 1,
            CURLOPT_HTTPHEADER => ['X-Yandex-API-Key: 6f2b9745-9c13-495e-80db-665cb97d994f'],
            CURLOPT_RETURNTRANSFER => 1,
        ]);
        
        $resp = curl_exec($ch);
        $data = json_decode($resp);

        return view('weather', ['data' => $data]);
    }
}
