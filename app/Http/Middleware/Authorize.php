<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Dotenv\Parser\Value;
use App\Models\Enums\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
 
class Authorize
{
    /**
     * Handle an incoming request.
     *
     * @param string $role
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
      if (Auth::user()->role->value !== $role) {
        return redirect()->route('main');
      }
      return $next($request);
    }
}