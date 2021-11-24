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
        $responseService = $client->request('POST', env('SEFVICE_MEMBER') . '/AuthEmployee', $options);
        $reponse = json_decode($responseService->getBody()->getContents(), false);

        dd($response->data);

        return response()->json($response,$responseService->getStatusCode());
        
        $random = Str::random(32);
        $secret_key = JWT::encode([
             'iss' => url('localhost:8002'),
             'iat' => time(),
            //  'sub' => $employee_id,
             'exp' => time() + 60 * 60 * 24 * 1
        ], env('JWT_SECRET'));
        
        // dd($request->getBody());
        //  return $body_array = json_encode($body, true);
         print("<pre>".print_r($body, true). "</pre>");
    }
}