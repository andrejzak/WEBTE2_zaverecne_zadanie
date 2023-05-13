<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class Authorize
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next, $permittedRoles)
  {
    if (!Str::contains($permittedRoles, 'admin')) {
      $permittedRoles = "admin|" . $permittedRoles;
    }

    $roles = explode('|', $permittedRoles);
    $userRole = Auth::user()->role->value;

    foreach ($roles as $role) {
      if ($role === $userRole) {
        return $next($request);
      }
    }
    throw new HttpResponseException(response()->json(['error' => 'Language not found'], Response::HTTP_NOT_FOUND));
  }
}
