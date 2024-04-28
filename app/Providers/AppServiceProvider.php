<?php

namespace App\Providers;

use App\Services\MediaContent\TVMazeAPI;
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
        $this->app->bind('App\Application\Utilities\MediaContent\TvShowsUtilitiesContract', 'App\Application\Utilities\MediaContent\TvShowsUtilities');
        $this->app->when('App\Application\Utilities\MediaContent\TvShowsUtilities')
            ->needs('App\Services\MediaContent\TvShowsApiContract')->give(TVMazeAPI::class);
    }
}
