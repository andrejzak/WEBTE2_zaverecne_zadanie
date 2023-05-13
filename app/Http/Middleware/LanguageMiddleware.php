<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Enums\Language;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Exceptions\HttpResponseException;

class LanguageMiddleware
{
  /**
   * If auth user is not company employee or admin return unauthorized, else redirect to response.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next)
  {
    $preferredLanguage = $request->getPreferredLanguage();
    $language = $request->route()->parameters()['lang'];
    if (!in_array($language, Language::values())) {
      throw new HttpResponseException(response()->json(['error' => 'Language not found'], Response::HTTP_NOT_FOUND));
    }
    App::setLocale($language);
    return $next($request);
  }
}
