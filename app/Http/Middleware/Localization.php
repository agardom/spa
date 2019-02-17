<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Foundation\Application;

class Localization
{

  /**
   * Localization constructor.
   *
   * @param \Illuminate\Foundation\Application $app
   */
  public function __construct(Application $app)
  {
      $this->app = $app;
  }

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    // Check header request for localization
    $locale = ($request->hasHeader('X-localization')) ? $request->header('X-localization') : 'en';

    // Check if language is available
    if (!array_key_exists($locale, $this->app->config->get('app.supported_languages'))){
      return response()->json('Language not supported.', 403);
    }

    // Set localization
    app()->setLocale($locale);

    // Continue request
    return $next($request);
  }
}
