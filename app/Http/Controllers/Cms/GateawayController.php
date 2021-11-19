<?php

namespace App\Http\Controllers\Cms;

use App\Cms\Http\EmployeeController;
use App\EmployeeModel;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class GateawayController extends Controller
{
    public function index(Request $request)
    {
        // dd("test");
        $client = new Client();
        // $client = new \GuzzleHttp\Client('GET', 'http://localhost:8002/Employee');
        $request = $client->get('http://localhost:8002/Employee/fetch');
        $response = $request->getBody()->getContents();
        
        $data = json_decode($response, true);

        print("<pre>".print_r($data, true). "</pre>");
    }

    public function detail($id)
    {
        $client = new \GuzzleHttp\Client('GET', 'http://localhost:8002/Employee');
        $request = $client->get ('http://localhost:8002/Employee');
        $response = $request->getBody()->getContents();
        
        $id = json_decode($response, true);

        print("<pre>".print_r($id, true). "</pre>");
    }
    

    public function store(Request $request)
    {
        $client = new \GuzzleHttp\Client('POST', 'http://localhost:8002/Employee');
        $request = $client->get ('http://localhost:8002/Employee');
        $response = $request->getBody()->getContents();
        
        $data = json_decode($response, true);

        print("<pre>".print_r($data, true). "</pre>");
    }

    public function update(Request $request, $id)
    {
        $client = new \GuzzleHttp\Client('PUT', 'http://localhost:8002/Employee');
        $request = $client->get ('http://localhost:8002/Employee');
        $response = $request->getBody()->getContents();
        
        $data = json_decode($response, true);

        print("<pre>".print_r($data, true). "</pre>");
    }
    
    public function delete($id)
    {
        $client = new \GuzzleHttp\Client('DELETE', 'http://localhost:8002/Employee');
        $request = $client->get ('http://localhost:8002/Employee');
        $response = $request->getBody()->getContents();
        
        $id = json_decode($response, true);

        print("<pre>".print_r($id, true). "</pre>");
    }
}
