<?php

namespace App\Http\Controllers\Cms;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;

class TourController
{
    /**
     * @throws GuzzleException
     */
    public function index(): JsonResponse
    {
        $klien = (new Client())->request('get', sprintf('%s/Tour/fetch', env('SERVICE_MEMBER')), [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ]
        ]);

        $respon = json_decode($klien->getBody()->getContents());

        return response()->json($respon, $klien->getStatusCode());
    }
}
