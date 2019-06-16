<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        $data['title'] = 'Главная страница';

        return view('welcome', $data);
    }

    public function getWeather() {
        $url = 'https://api.weather.yandex.ru/v1/informers?lat=53.243562&lon=34.363407&extra=true&lang=ru_RU';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_HTTPHEADER,['X-Yandex-API-Key: c84cfd48-fa78-4255-9b0f-8b5b1b367a0c']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $returned = curl_exec($ch);
        curl_close ($ch);
        $returned = json_decode($returned);
        $weatherData['temp'] = $returned->fact->temp;
        $weatherData['urlIconTemp'] = 'https://yastatic.net/weather/i/icons/blueye/color/svg/' . $returned->fact->icon . '.svg';
        $weatherData['urlCity'] = $returned->info->url;
        $data['title'] = 'Погода в Брянске';
        $data['weather'] = $weatherData;
        $data['weatherPage'] = 1;

        return view('welcome', $data);
    }
}
