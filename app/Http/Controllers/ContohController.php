<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ContohController extends Controller
{
    public function fetch()
    {
        $client = new Client();
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => ' application/json',
            ],
        ];
        $responseService = $client->request('GET', env('SERVICE_MEMBER') . '/contoh', $options);
        $response = json_decode($responseService->getBody()->getContents(), false);
        return response()->json($response, $responseService->getStatusCode());
    }

    public function detail($id)
    {
        $client = new Client();
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => ' application/json',
            ],
        ];
        $responseService = $client->request('GET', env('SERVICE_MEMBER') . '/contoh/' . $id, $options);
        $response = json_decode($responseService->getBody()->getContents(), false);
        return response()->json($response, $responseService->getStatusCode());
    }

    public function store(Request $request)
    {
        $client = new Client();
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => ' application/json',
            ],
            'json' => $request->all()
        ];
        $responseService = $client->request('POST', env('SERVICE_MEMBER') . '/contoh', $options);
        $response = json_decode($responseService->getBody()->getContents(), false);
        return response()->json($response, $responseService->getStatusCode());
    }

    public function update(Request $request, $id)
    {
        $client = new Client();
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => ' application/json',
            ],
            'json' => $request->all()
        ];
        $responseService = $client->request('PUT', env('SERVICE_MEMBER') . '/contoh/' . $id, $options);
        $response = json_decode($responseService->getBody()->getContents(), false);
        return response()->json($response, $responseService->getStatusCode());
    }

    public function destroy($id)
    {
        $client = new Client();
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => ' application/json',
            ],
        ];
        $responseService = $client->request('DELETE', env('SERVICE_MEMBER') . '/contoh/' . $id, $options);
        $response = json_decode($responseService->getBody()->getContents(), false);
        return response()->json($response, $responseService->getStatusCode());
    }
}
