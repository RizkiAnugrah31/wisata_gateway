<?php

namespace App\Http\Controllers\Cms;

use App\EmployeeModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $client = new \GuzzleHttp\Client();;
        $request = $client->get('http://localhost:8002/Employee/fetch');
        $response = $request->getBody()->getContents();
        
        return $data = json_decode($response, true);

        print("<pre>".print_r($data, true). "</pre>");
        
        
    }

    public function detail($id){
        // dd("test");
        $client = new \GuzzleHttp\Client();;
        $request = $client->get('http://localhost:8002/Employee/detail/'.$id);
        $response = $request->getBody()->getContents();
        
        return $data = json_decode($response, true);

        print("<pre>".print_r($data, true). "</pre>");
    }

    public function store(Request $request)
    {
        // dd('test');
        $client = new \GuzzleHttp\Client();;
        $request = $client->post('http://localhost:8002/Employee/store');
       
        $response = $request->getBody()->getContents();
        
        return $data= json_decode($response, true);

        print("<pre>".print_r($data, true). "</pre>");

        // $response = $client->request('POST', 'http://localhost:8002/Employee/store', [
        //     'json' => [
        //         'user_roles_id' => '2',
        //         'employee_firstname' => 'Putri',
        //         'employee_middlename' => 'Nadya',
        //         'employee_lastname' => 'En',
        //         'employee_username' => 'Putrinadyaen',
        //         'employee_password' => '1234567',
        //         'employee_email' => 'putrinadya@gmail.com',
        //         'employee_status' => '1',
        //         'employee_image' => '',
        //         'created_by' => '1',
        //         'update_by' => '1'
        //     ]
        // ]);
    //     $body = $response->getBody();
    //     return $body_array = json_decode($body);
    //     print_r($body_array);
    // 
    }

    public function update(Request $request, $id)
    {
        $client = new \GuzzleHttp\Client();;
        $request = $client->put('http://localhost:8002/Employee/update');
        $response = $request->getBody()->getContents();
        
        return $data = json_decode($response, true);

        print("<pre>".print_r($data, true). "</pre>");
    }

    public function delete($id)
    {
       $client = new \GuzzleHttp\Client();;
        $request = $client->delete('http://localhost:8002/Employee/delete');
        $response = $request->getBody()->getContents();
        
        return $data = json_decode($response, true);

        print("<pre>".print_r($data, true). "</pre>");
    }
}
