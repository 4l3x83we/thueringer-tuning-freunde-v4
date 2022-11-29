<?php

use App\Http\Controllers\Intern\Admin;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['namespace' => 'App\Http\Controllers'], function () {

    // Index Page
    Route::get('/', function () {
        return view('welcome');
    });

    // Gäste Route
    Route::group(['middleware' => ['guest']] , function () {
        Auth::routes(['register' => false]);
    });

    // Interne/AdminRoute
    Route::group(['middleware' => ['auth', 'permission']], function () {
        // Intern
        Route::group(['prefix' => 'intern', 'namespace' => 'Intern'], function () {

            // Admin
            Route::group(['prefix' => 'intern', 'namespace' => 'Admin'], function () {
                Route::resource('users', Admin\UsersController::class);
            });

            
        });
    });

});

// Cache & Sitemap Route
Route::middleware(['auth'])->group(function () {
// Clear route cache
    Route::get('/sitemap-generate', function () {
        Artisan::call('generate:sitemap');
        return redirect('sitemap.xml');
    });

    Route::get('/route-cache', function () {
        Artisan::call('route:clear');
        return 'Routes cache cleared';
    });
// Clear config cache
    Route::get('/config-cache', function () {
        Artisan::call('config:clear');
        return 'Config cache cleared';
    });
// Clear application cache
    Route::get('/cache-clear', function () {
        Artisan::call('cache:clear');
        return 'Application cache cleared';
    });
// Clear view cache
    Route::get('/view-clear', function () {
        Artisan::call('view:clear');
        return 'View cache cleared';
    });
// Clear cache using reoptimized class
    Route::get('/optimize-clear', function () {
        Artisan::call('optimize:clear');
        return 'View cache cleared';
    });
});
