<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



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
