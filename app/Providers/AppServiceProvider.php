<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Disable lazy loading in develop env
        Model::preventLazyLoading(! app()->isProduction());

        // Turn off JSON resource data wrapper
        JsonResource::withoutWrapping();

        // Success redirect response macro
        RedirectResponse::macro('withSuccess', function (string $value): RedirectResponse {
            return $this->with('success', $value);
        });
    }
}
