<?php

use Illuminate\Support\Facades\Http;

// API

const API = '192.168.1.29:2020/';

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