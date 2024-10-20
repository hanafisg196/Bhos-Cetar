<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthUserMananger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      $accesRule = ['ADMIN', 'KABAG'];
      $userHasAccess = Auth::user()->rules->pluck('nama')->intersect($accesRule)->isNotEmpty();
      if ($userHasAccess) {
          return $next($request);
      } else {
          abort(404);
      }
    }
}
