<?php

namespace App\Providers;

use AmidEsfahani\FilamentTinyEditor\TinyeditorServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TinyeditorServiceProvider::class, MyTinyEditorServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
