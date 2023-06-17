<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocaleMiddleware
{
    private const DEFAULT_LOCALE = 'cs';

    public function handle(Request $request, Closure $next)
    {
        app()->setLocale(session()->get('locale', self::DEFAULT_LOCALE));

        return $next($request);
    }
}
