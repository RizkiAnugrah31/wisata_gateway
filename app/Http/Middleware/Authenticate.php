<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // dd($request->bearerToken());

        if(empty($request->bearerToken())) {
            return response()->json([
                'data' => '',
                'message' => 'invalid',
                'seccess' => false
            ]);
        } 
 
        try{
            $decode_token = JWT::decode($secret_key.'tokenJadiSalah',env('JWT_SECRET'), ['HS256']);

           } catch (\Exception $exception) {
               return response()->json([
                   'data' => new \stdClass(),
                   'message' =>$exception->getMessage(),
                   'success' => false
               ], 401);
           }
           $request->auth = $decode_token;
           return $next($request);
            
        
    }
}
