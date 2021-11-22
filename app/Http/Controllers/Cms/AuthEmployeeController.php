<?php
namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeModel;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Str;

class AuthEmployeeController extends Controller
{
    public function login(Request $request)
    {     
        $client = new \GuzzleHttp\Client();;
        $clientRequest = $client->post(env('SERVICE_MEMBER').'/Employee/login');
        $request->only(
                'user_roles_id',
                'employee_firstname' ,
                'employee_middlename' ,
                'employee_lastname' ,
                'employee_username' ,
                'employee_email' ,
                'employee_image' 
        );
        
        $response = $clientRequest->getBody()->getContents();

        dd($response);
        $random = Str::random(32);
        $secret_key = JWT::encode([
             'iss' => url('localhost:8002'),
             'iat' => time(),
            //  'sub' => $AuthController->employee_id,
             'exp' => time() + 60 * 60 * 24 * 1
        ], env('JWT_SECRET'));
        
        // dd($responseService->data());
         return $body_array = json($response, true);
         print("<pre>".print_r($encode, true). "</pre>");
    }
}