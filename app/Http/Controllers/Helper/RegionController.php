<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public static function provinces()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://api.rajaongkir.com/starter/province', [
            'headers' => [
                'key' => env('RAJAONGKIR_API_KEY')
            ]
        ]);

        $provinces = json_decode($response->getBody())->rajaongkir->results;

        return $provinces;
    }

    public static function city($province)
    {
        $client = new Client();
        $response = $client->request('GET', 'https://api.rajaongkir.com/starter/city', [
            'headers' => [
                'key' => env('RAJAONGKIR_API_KEY')
            ],
            'query' => [
                'province' => $province,
            ],
        ]);

        $cities = json_decode($response->getbody())->rajaongkir->results;

        return $cities;
    }
}
