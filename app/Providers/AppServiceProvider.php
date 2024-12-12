<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
        DB::listen(function ($query) {
            $bindings = array_map(
                fn($value) => is_numeric($value) ? $value : "'{$value}'",
                $query->bindings
            );

            Log::debug(
                Str::replaceArray('?', $bindings, $query->sql),
                []
            );
        });
    }
}
