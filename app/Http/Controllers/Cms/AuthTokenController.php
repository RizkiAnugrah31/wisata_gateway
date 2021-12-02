<?php
namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CredentialsModel;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use App\Http\Controllers\Cms\TokenController;


class AuthTokenController extends Controller
{
    public function login(Request $request)
    {    
        // dd($request->bearerToken());
        $client = new Client();
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => ' application/json',
            ],
            'json' => $request->all()
        ];
        $responseService = $client->request('POST', env('SERVICE_MEMBER') . '/Credentials/login', $options);
        $response = json_decode($responseService->getBody()->getContents(), false );

        // dd($response->data);
        // dd($response->data->employee_id);
        // return response()->json($response , $responseService->getStatusCode());
        // dd($response->success);
        if($response->success) {
            $secret_key = JWT::encode([
                'iss' => url(),
                'iat' => time(),
                'sub' => $response->data->credential_id,
                'exp' => time() + 60 * 60 * 24 * 1
           ], env('JWT_SECRET'));
           
            return response()->json([
                'data' => [
                    'credential_id' => $response->data->credential_id,
                    'platfrom' => $response->data->platfrom,
                    'secret_key' => $secret_key
                ],
                'message' => 'Valid',
                'success' => true,
            
            ]);
          } else {
            return response()->json([
                'data' => new \stdClass(),
                'message' => "Data Tidak Valid",
                'success' => false
            ]);
        }
}

        

       
}        
        