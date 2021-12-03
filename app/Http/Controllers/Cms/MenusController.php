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
        // dd("test");
        $client = new Client();

        // $options = [
        //     'headers' => [
        //         'Accept' => 'application/json',
        //         'Content-Type' => ' application/json',
        //     ],
        // ];
        $responseService = $client->request('GET', env('SERVICE_MEMBER') . '/Menus/detail', $id);
        $response = json_decode($responseService->getBody()->getContents(), false);

        // dd($response->data);

        return response()->json($response,$responseService->getStatusCode());
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
        $responseService = $client->request('PUT', env('SERVICE_MEMBER') . '/Menus/update', $options);
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
       $client = new \GuzzleHttp\Client();;
        $request = $client->delete('http://localhost:8002/Employee/delete'.$id);
        $response = $request->getBody()->getContents();
        
        return $data = json_decode($response, true);

        print("<pre>".print_r($data, true). "</pre>");
    }
}
