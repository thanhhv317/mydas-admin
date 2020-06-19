<?php

use Illuminate\Support\Facades\Http;

// API

const API = 'http://localhost:2020/';

if (!function_exists('api')) {
    function api($url, $method = 'GET', $parameters = [], $token='') {
        $arrHeader = array(
            'Authorization' => (session('user_data')&&!$token ? session('user_data')['token'] : $token)
        );
        $uri = API . $url;
        $response = Http::withHeaders($arrHeader)->$method($uri, $parameters);
        return json_decode($response->getBody()->getContents(), true);
    }
}



?>