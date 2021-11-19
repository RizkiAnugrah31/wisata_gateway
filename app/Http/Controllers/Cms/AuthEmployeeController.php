<?php
namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\EmployeeModel;

class AuthEmployeeController extends Controller
{
    public function login(Request $request)
    {     
        $client = new \GuzzleHttp\Client();;
        $request = $client->get(env('SEVIDE_MEMBER').'/Employee/fetch');
        $request->only(
                'user_roles_id' => '3',
                'employee_firstname' 
                'employee_middlename' 
                'employee_lastname' 
                'employee_username' 
                'employee_email' 
                'employee_image' 
        );
        
        $body = $response->getBody();
        return $body_array = 
        
    }
}