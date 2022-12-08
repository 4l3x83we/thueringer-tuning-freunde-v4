<?php

use App\Http\Controllers\Auth\MyWelcomeController;
use App\Http\Controllers\Frontend;
use App\Http\Controllers\Intern;
use App\Http\Controllers\Intern\Admin;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\WelcomeNotification\WelcomesNewUsers;

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
Route::get('/test', function () {
    $teams = \App\Models\Frontend\Album\Photo::find(1);
    dump($teams->teams, $teams->users);
    dump($teams, $teams->fahrzeuges, $teams->albums);
});

Route::namespace('App\Http\Controllers')->group(function () {
    // Index Page
    Route::name('frontend.')->namespace('Frontend')->group(function () {
        Route::get('/', [Frontend\IndexController::class, 'index'])->name('index');

        // Team
        Route::resource('team', Frontend\Team\TeamsController::class);
        Route::match(['PUT', 'PATCH'], 'team/memberDelete/{team}', [Frontend\Team\TeamsController::class, 'updateMember'])->name('team.update-member');

        // Antrag
        Route::get('/antrag', [Frontend\AntragController::class, 'index'])->name('antrag.index');
        Route::post('/antrag', [Frontend\AntragController::class, 'store'])->name('antrag.store');

        // Gallery
        Route::resource('galerie', Frontend\Album\AlbumsController::class);
        Route::resource('galerie/photos', Frontend\Album\PhotosController::class);
        Route::match(['PUT', 'PATCH'], 'galerie/photos/preview/{photo:id}', [Frontend\Album\PhotosController::class, 'updatePreview'])->name('albums.update-preview');

        // Kontakt
        Route::resource('/kontakt', Frontend\KontaktsController::class)->only('index', 'store');

        // Impressum
        Route::get('/impressum', [Frontend\IndexController::class, 'impressum'])->name('impressum');
        Route::get('/datenschutz', [Frontend\IndexController::class, 'datenschutz'])->name('datenschutz');
    });

    // Gäste Route
    Route::middleware('guest')->group(function () {
        Auth::routes(['register' => false]);
    });

    // Interne/AdminRoute
    Route::middleware(['auth'])->group(function () {
        // Intern
        Route::name('intern.')->prefix('intern')->namespace('Intern')->group(function () {
            // Album veröffentlichen
            Route::match(['PUT', 'PATCH'], '/galerie/published/{galerie}', [Frontend\Album\AlbumsController::class, 'published'])->name('galerie.published-galerie');

            // Admin
            Route::name('admin.')->prefix('admin')->namespace('Admin')->group(function () {
                Route::resource('users', Admin\UsersController::class);
                Route::resource('roles', Admin\RolesController::class);
                Route::resource('permissions', Admin\PermissionsController::class);

                // Antrag
                Route::get('/antrag', [Frontend\AntragController::class, 'indexAdmin'])->name('antrag.index');
                Route::get('/antrag/{antrag:id}', [Frontend\AntragController::class, 'show'])->name('antrag.show');
                Route::match(['PUT', 'PATCH'], '/antrag/checked/{antrag}', [Frontend\AntragController::class, 'checked'])->name('antrag.checked-antrag');
                Route::match(['PUT', 'PATCH'], '/antrag/revoke/{antrag}', [Frontend\AntragController::class, 'revoke'])->name('antrag.revoke-antrag');
                Route::delete('/antrag/destroy/{antrag}', [Frontend\AntragController::class, 'destroy'])->name('antrag.destroy');
            });
        });
    });
});

Route::group(['middleware' => ['web', WelcomesNewUsers::class,]], function () {
    Route::get('welcome/{user}', [MyWelcomeController::class, 'showWelcomeForm'])->name('welcome');
    Route::post('welcome/{user}', [MyWelcomeController::class, 'savePassword']);
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
