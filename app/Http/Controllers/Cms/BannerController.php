<?php

namespace App\Http\Controllers\Cms;

use App\BannerModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class BannerController extends Controller
{
    
    public function index(Request $request)
    {
        $client = new Client();
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ];
        $responseService = $client->request('GET', env('SERVICE_MASTER') .'/Banner/fetch', $options);
        $response = json_decode($responseService->getBody()->getContents(), false);
        // uncomment di bawah bwt cek ambil data
        
        //  dd($response->data);
        
         // uncomment di bawah bwt cek ambil data dan yg pertama
       
        return response()->json($response, $responseService->getStatusCode());

        // print("<pre>".print_r($data, true). "</pre>");

        
    }
   
    public function detail($id){
        //  dd("test");
        $client = new \GuzzleHttp\Client();;
        $request = $client->get('http://localhost:8003/Banner/detail/'.$id);
        $response = $request->getBody()->getContents();
        
        return $data = json_decode($response, true);

        // print("<pre>".print_r($data, true). "</pre>");
    }

    public function store(Request $request)
    {
        $client = new Client();
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => $request->all()
        ];
        $responseService = $client->request('POST', env('SERVICE_MASTER') . '/Banner/store', $options);
        $response = json_decode($responseService->getBody()->getContents(), false);
        // return response()->json($response, $responseService->getStatusCode());

        // dd($request->all());
        if ($response->succes){
            return response()->json([
            'data'=> $response,
            'message' => 'valid', 
            'succes' => true
            ]);
        
        }else {
            return response()->json([
            'message'=>'invalid',
            'succes'=>false
           
            ]);
                
    }

}
    public function update(Request $request, $id)
    {
        
        
        $client = new \GuzzleHttp\Client();
        $response = $client->request('PUT', 'http://localhost:8003/Banner/store'.$id , [
            'json' => [
                'banner_id' => '5',
                'tour_id'   => '3'
               
            ]
        ]);
        $body = $response->getBody();
        return $body_array = json_decode($body, true);
        print("<pre>".print_r($body, true). "</pre>");
    
    }

    public function delete($id)
    {
       $client = new \GuzzleHttp\Client();;
        $request = $client->delete('http://localhost:8003/Banner/delete'.$id);
        $response = $request->getBody()->getContents();
        
        return $data = json_decode($response, true);

        print("<pre>".print_r($data, true). "</pre>");
    }
}
