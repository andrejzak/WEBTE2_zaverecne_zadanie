<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Session::has('applocale') && in_array(Session::get('applocale'), ['sk', 'en'])) {
            App::setLocale(Session::get('applocale'));
        }

        return $next($request);
    }
}
