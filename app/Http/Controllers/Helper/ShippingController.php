<?php

namespace App\Http\Controllers\Helper;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShippingController extends Controller
{
    public static function shipping($city, $courier, $weight)
    {
        $client = new Client();
        $response = $client->post('https://api.rajaongkir.com/starter/cost', [
            'headers' => [
                'content-type' => 'application/x-www-form-urlencoded',
                'key' => env('RAJAONGKIR_API_KEY')
            ],
            'form_params' => [
                'origin' => '419',
                'destination' => $city,
                'weight' => $weight,
                'courier' => $courier
            ]
        ]);

        $cost = json_decode($response->getbody())->rajaongkir->results[0]->costs[0]->cost[0]->value;

        return $cost;
    }
}
