<?php

namespace App\Http\Controllers\Cms;

use App\MenuGroupsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class MenuGroupsController extends Controller
{
    public function index(Request $request)
    {
        $client = new Client();
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => ' application/json',
            ],
        ];
        $responseService = $client->request('GET', env('SERVICE_MEMBER') . '/MenuGroups/fetch', $options);
        $response = json_decode($responseService->getBody()->getContents(), false);
        // dd($response->data);
        return response()->json($response,$responseService->getStatusCode());
    }

    public function detail($id){
        $client = new Client();
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => ' application/json',
            ],
        ];
        $responseService = $client->request('GET', env('SERVICE_MEMBER') . '/MenuGroups/detail/'. $id , $options);
        $response = json_decode($responseService->getBody()->getContents(), false);
        
        // dd($response->success);
        return response()->json($response, $responseService->getStatusCode());
    }

    public function store(Request $request)
    {
        // dd('test');
        $client = new Client();
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => ' application/json',
            ],
            'json' => $request->all()
        ];
        $responseService = $client->request('POST', env('SERVICE_MEMBER') . '/MenuGroups/store', $options);
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
        $responseService = $client->request('PUT', env('SERVICE_MEMBER') . '/MenuGroups/update/'.$id , $options);
        $response = json_decode($responseService->getBody()->getContents(), false);
        return response()->json($response, $responseService->getStatusCode());
    
    }

    public function delete($id)
    {
        $client = new Client();
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => ' application/json',
            ],
        ];
        $responseService = $client->request('DELETE', env('SERVICE_MEMBER') . '/MenuGroups/delete/'.$id, $options);
        $response = json_decode($responseService->getBody()->getContents(), false);
        return response()->json($response, $responseService->getStatusCode());
    }
}
