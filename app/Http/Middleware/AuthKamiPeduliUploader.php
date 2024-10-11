<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthKamiPeduliUploader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      $typeRule = [
         "SEKRETARIS"
       ];
         $role = $request->session()->get('user_role');
         if(in_array($role, $typeRule))
         {
             return $next($request);
         }
         else {
               abort(404);
         }
    }
}
