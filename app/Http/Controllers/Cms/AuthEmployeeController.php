<?php
namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EmployeeModel;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use App\Http\Controllers\Cms\Authcontroller;


class AuthEmployeeController extends Controller
{
    public function login(Request $request)
    {     
        $client = new Client();
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => ' application/json',
            ],
            'json' => $request->all()
        ];
        $responseService = $client->request('POST', env('SERVICE_MEMBER') . '/Employee/login', $options);
        $response = json_decode($responseService->getBody()->getContents(), false);

        // dd($response->data);
        // dd($response->data[0]);
        // dd($response->data->employee_id);


        // return response()->json($response , $responseService->getStatusCode());
        
        
       
        // dd($response->success);
        if($response->success) {
            $secret_key = JWT::encode([
                'iss' => url('http://localhost:8001/localhost:8002'),
                'iat' => time(),
                'sub' => $response->data->employee_id,
                'exp' => time() + 60 * 60 * 24 * 1
           ], env('JWT_SECRET'));

            return response()->json([
                'data' => [
                    'employee_id' => $response->data->employee_id,
                    'employee_firstname' => $response->data->employee_firstname,
                    'employee_middlename' => $response->data->employee_middlename,
                    'employee_lastname' => $response->data->employee_lastname,
                    'employee_username' => $response->data->employee_username,
                    'employee_image' => $response->data->employee_image,
                    'secret_key' => $secret_key
                ],
                'message' => 'Valid',
                'success' => true,
            
            ]);
        } else {
            return response()->json([
                'data' => new\stdClass(),
                'message' => "Invalid1",
                'success' => false
            ]);
        }

        

       

        
        // dd($request->getBody());
        //  return $secret_key = json($secret_key, true);
        //  print("<pre>".print_r($secret_key, true). "</pre>");
    }
}