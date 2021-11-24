<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ContohController extends Controller
{
    // Example GET
    public function exampleGet()
    {
        $client = new Client();
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ];
        $responseService = $client->request('GET', env('SERVICE_MEMBER') . '/contoh', $options);
        $response = json_decode($responseService->getBody()->getContents(), false);
        // uncomment di bawah bwt cek ambil data
        // dd($response->data);
        // uncomment di bawah bwt cek ambil data dan yg pertama
        // dd($response->data[0]);
        return response()->json($response, $responseService->getStatusCode());
    }

    // Example POST
    public function examplePost(Request $request)
    {
        $client = new Client();
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => $request->all()
        ];
        $responseService = $client->request('POST', env('SERVICE_MEMBER') . '/contoh', $options);
        $response = json_decode($responseService->getBody()->getContents(), false);
        return response()->json($response, $responseService->getStatusCode());
    }

    public function exampleGetParam()
    {
        // sama aja kek examplePost bedanya inisialisasinya
        $parameter = \request()->all();
        return $parameter;
    }
}
