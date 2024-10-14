<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      $userId = Auth::user()->id;
      $user = User::find($userId);
      $rule = ['ADMIN', 'KABAG', 'VERIFIKATOR 1', 'VERIFIKATOR 2'];
      $hasAnyRole = $user->rules()->whereIn('nama', $rule);
         if($hasAnyRole)
         {
             return $next($request);
         }
         else {
               abort(404);
         }
    }
}
