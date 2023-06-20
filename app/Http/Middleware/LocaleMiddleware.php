<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LocaleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->cookie('locale')) {
            app()->setLocale($request->cookie('locale'));
        }

        return $next($request);
    }
}
