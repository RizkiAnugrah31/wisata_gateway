<?php
namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EmployeeModel;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Str;
use App\Http\Controllers\Cms\Authcontroller;


class AuthEmployeeController extends Controller
{
    public function login(Request $request)
    {     
        $client = new Client();
        $serviceResponse = $client->request('POST', env('SERVICE_MEMBER').'/Employee/login', [
            'headers' => [
                'accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'json' => $request->only(
                        'employee_email' ,
                        'employee_password'
                    )
            ]);
        return $serviceResponse->getBody()->body->employee_email;
        $request = $client->post(env('SERVICE_MEMBER').'/Employee/login',[
            'json' => $request->only(
                        'employee_email' ,
                        'employee_password'
                    )
        ]);
        dd($request->getData());
        return $request;
        $body = $request->getBody();

        
        $random = Str::random(32);
        $secret_key = JWT::encode([
             'iss' => url('localhost:8002'),
             'iat' => time(),
            //  'sub' => $employee_id,
             'exp' => time() + 60 * 60 * 24 * 1
        ], env('JWT_SECRET'));
        
        // dd($request->getBody());
         return $body_array = json_encode($body, true);
         print("<pre>".print_r($body, true). "</pre>");
    }
}