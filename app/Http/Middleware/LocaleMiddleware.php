<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\LocaleMiddleware as Middleware;
use Closure;

class LocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        if (session()->has('locale')) {
            app()->setLocale(session()->get('locale'));
        } else {
            app()->setLocale(config('app.locale'));
        }

        return $next($request);
    }
}
