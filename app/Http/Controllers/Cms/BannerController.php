<?php

namespace App\Http\Controllers\Cms;

use App\BannerModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class BannerController extends Controller
{
    
    public function index(Request $request)
    {
        $client = new \GuzzleHttp\Client();;
        $request = $client->get('http://localhost:8003/Banner/fetch');
        $response = $request->getBody()->getContents();
        
        return $data = json_decode($response, true);

        print("<pre>".print_r($data, true). "</pre>");
        
        
    }

    public function detail($id){
        // dd("test");
        $client = new \GuzzleHttp\Client();;
        $request = $client->get('http://localhost:8003/Banner/detail/'.$id);
        $response = $request->getBody()->getContents();
        
        return $data = json_decode($response, true);

        print("<pre>".print_r($data, true). "</pre>");
    }

    public function store(Request $request)
    {
        

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'http://localhost:8003/Banner/store', [
            'json' => [
                'banner_id' => '2',
                'tour_id'   => '4'
                
            ]
        ]);
        $body = $response->getBody();
        return $body_array = json_decode($body, true);
        print("<pre>".print_r($body, true). "</pre>");
    
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
