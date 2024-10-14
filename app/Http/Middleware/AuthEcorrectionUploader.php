<?php

namespace App\Http\Middleware;

use App\Models\Rule;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthEcorrectionUploader
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
      $rule = ['KABID'];
      $hasRole = $user->rules()->whereIn('nama', $rule);
         if($hasRole)
         {
             return $next($request);
         }
         else {
               abort(404);
         }
    }
}
