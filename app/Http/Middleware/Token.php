<?php

namespace App\Http\Middleware;

use Closure;

class Token
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if(empty($secret_key->getToken())) {
           return response()->json([
               'data' => '',
               'message' => 'invalid',
               'success' => false
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
       $request->getToken = $decode_token;
       return $next($request);
    }
}
