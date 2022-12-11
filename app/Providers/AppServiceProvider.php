<?php

namespace App\Providers;

use App\Models\Frontend\Team\Team;
use App\Models\Kontakt;
use Illuminate\Foundation\Vite;
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
            $count = [
                'kontakt' => Kontakt::where('read', false)->select('read')->count(),
            ];
            $kontakteNotification = Kontakt::where('read', false)->limit(3)->get();
            $geb = Team::where('published', true)->orderBy('title', 'ASC')->get();
            $view->with('count', $count);
            $view->with('kontakteNotification', $kontakteNotification);
            $view->with('geb', $geb);
        });
    }
}
