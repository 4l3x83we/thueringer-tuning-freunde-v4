<?php

namespace App\Providers;

use App\Models\Frontend\Team\Team;
use Illuminate\Foundation\Vite;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Vite::macro('image', fn($asset) => $this->asset("resources/images/{$asset}"));
        Vite::macro('images', fn($asset) => $this->asset("resources/{$asset}"));
        Paginator::useBootstrapFive();
        Route::resourceVerbs([
            'edit' => 'bearbeiten',
            'create' => 'erstellen'
        ]);
        view()->composer('*', function ($view) {
            $geb = Team::where('published', true)->orderBy('title', 'ASC')->get();
            $view->with('geb', $geb);
        });
    }
}
