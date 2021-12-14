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
        $client = new Client();
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => ' application/json',
            ],
        ];
        $responseService = $client->request('GET', env('SERVICE_MEMBER') . '/Employee/fetch', $options);
        $response = json_decode($responseService->getBody()->getContents(), false);

        // dd($response->data);

        return response()->json($response,$responseService->getStatusCode());
    }

    public function detail($id){
        // dd("test");
        $client = new Client();
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => ' application/json',
            ],
        ];
        $responseService = $client->request('GET', env('SERVICE_MEMBER') . '/Employee/detail/'. $id , $options);
        $response = json_decode($responseService->getBody()->getContents(), false);

        // dd($response->data);

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
        $responseService = $client->request('POST', env('SERVICE_MEMBER') . '/Employee/store', $options);
        $response = json_decode($responseService->getBody()->getContents(), false);
       
        if ($response->success) {
                return response()->json([
                    'data' => [
                        'user_roles_id' => $response->data->user_roles_id,
                        'employee_id' => $response->data->employee_id,
                        'employee_firstname' => $response->data->employee_firstname,
                        'employee_middlename' => $response->data->employee_middlename,
                        'employee_lastname' => $response->data->employee_lastname,
                        'employee_username' => $response->data->employee_username,
                        'employee_image' => $response->data->employee_image,
                        'employee_status' => $response->data->employee_status,
                        'created_by' => $response->data->created_by,
                        'update_by' => $response->data->updated_by
                    ],
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
        $responseService = $client->request('PUT', env('SERVICE_MEMBER') . '/Employee/update', $options);
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
