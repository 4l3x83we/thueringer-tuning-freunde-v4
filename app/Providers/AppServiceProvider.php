<?php

namespace App\Providers;

use App\Models\Frontend\Team\Team;
use Illuminate\Database\Eloquent\Model;
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
        Model::preventLazyLoading(!$this->app->isProduction());
        Model::handleLazyLoadingViolationUsing(function ($model, $relation) {
            $class = get_class($model);
            info("Es wurde versucht, [{$relation}] auf Modell [{$class}] verzögert zu laden.");
        });
        Vite::macro('image', fn($asset) => $this->asset("resources/images/{$asset}"));
        Vite::macro('images', fn($asset) => $this->asset("resources/{$asset}"));
        Paginator::useBootstrapFive();
        Route::resourceVerbs([
            'edit' => 'bearbeiten',
            'create' => 'erstellen'
        ]);
        /*view()->composer('*', function ($view) {
            $geb = Team::where('published', true)->orderBy('title', 'ASC')->get();
            $view->with('geb', $geb);
        });*/
    }
}
