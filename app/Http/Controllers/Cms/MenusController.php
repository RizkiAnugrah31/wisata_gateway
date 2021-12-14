<?php

namespace App\Http\Controllers\Cms;

use App\MenusModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class MenusController extends Controller
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
        $responseService = $client->request('GET', env('SERVICE_MEMBER') . '/Menus/fetch', $options);
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
        $responseService = $client->request('GET', env('SERVICE_MEMBER') . '/Menus/detail/{id}', $options);
        $response = json_decode($responseService->getBody()->getContents(), false);
        
        // dd($response->success);
        if ($response->success) {
                return response()->json([
                    'data' => $response,
                    'message' => 'Valid',
                    'success' => true
                ]);
        }  else {
                return response()->json([
                    'data' => '',
                    'message' => 'Tidak Valid',
                    'success' => false
                ]);
        }
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
        $responseService = $client->request('POST', env('SERVICE_MEMBER') . '/Menus/store', $options);
        $response = json_decode($responseService->getBody()->getContents(), false);
       
        if ($response->success) {
                return response()->json([
                    'data' => $response,
                    'message' => 'Valid',
                    'success' => true
                ]);
        }  else {
                return response()->json([
                    'data' => '',
                    'message' => 'tidak Valid',
                    'success' => false
                ]);
        }
    
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
        $responseService = $client->request('PUT', env('SERVICE_MEMBER') . '/Menus/update/{id}', $options);
        $response = json_decode($responseService->getBody()->getContents(), false);
       
        if ($response->success) {
                return response()->json([
                    'data' => $response,
                    'message' => 'Valid',
                    'success' => true
                ]);
        }  else {
                return response()->json([
                    'data' => '',
                    'message' => 'tidak Valid',
                    'success' => false
                ]);
        }
    
    }

    public function delete($id)
    {
        $client = new Client();
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => ' application/json',
            ],
            'json' => $request->all()
        ];
        $responseService = $client->request('DELETE', env('SERVICE_MEMBER') . '/Menus/delete', $options);
        $response = json_decode($responseService->getBody()->getContents(), false);
        $parameter = \request($id)->all();
        
        if ($response->success) {
                return response()->json([
                    'data' => $response,
                    'message' => 'Valid',
                    'success' => true
                ]);
        }  else {
                return response()->json([
                    'data' => '',
                    'message' => 'tidak Valid',
                    'success' => false
                ]);
        }
    }
}
