<?php

use App\Http\Controllers\Auth\MyWelcomeController;
use App\Http\Controllers\Frontend;
use App\Http\Controllers\Intern;
use App\Http\Controllers\Intern\Admin;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\WelcomeNotification\WelcomesNewUsers;
use Yoeunes\Toastr\Facades\Toastr;

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

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/*Route::get('/test', function () {
    $teams = \App\Models\Frontend\Album\Photo::find(1);
    dump($teams->teams, $teams->users);
    dump($teams, $teams->fahrzeuges, $teams->albums);
});*/

/*Route::get('/testen', function () {
    $paids = App\Models\Frontend\Team\Team::select('vorname', 'nachname', 'zahlung', 'zahlungsArt')->where('published', true)->get();
    $dateNow = Carbon\Carbon::parse(now())->format('d.m.Y');
    $bezahlt = \App\Models\Intern\Admin\PaymentOpenPaid::all();
    $test = null;
    if ($dateNow >= '01.01.2023' and $dateNow) {
        $test = $dateNow;
    }
    $zahlung = new \App\Models\Intern\Admin\PaymentOpenPaid();

    return [
        'dateNow' => $dateNow,
        'test' => $test,
        'paid' => $paids,
        'bezahlt' => $bezahlt,
        'zahlung' => $zahlung,
    ];
});*/

Route::namespace('App\Http\Controllers')->group(function () {
    Auth::routes(['register' => false]);

    // Index Page
    Route::name('frontend.')->namespace('Frontend')->group(function () {
        Route::get('/', [Frontend\IndexController::class, 'index'])->name('index');

        // Team
        Route::resource('team', Frontend\Team\TeamsController::class);
        Route::match(['PUT', 'PATCH'], 'team/memberDelete/{team}', [Frontend\Team\TeamsController::class, 'updateMember'])->name('team.update-member');

        // Fahrzeuge
        Route::resource('fahrzeuge', Frontend\Fahrzeuge\FahrzeugsController::class);
        Route::match(['PUT', 'PATCH'], 'fahrzeuge/unpublished/{fahrzeuge}', [Frontend\Fahrzeuge\FahrzeugsController::class, 'unpublished'])->name('fahrzeuge.unpublished');
        Route::match(['PUT', 'PATCH'], 'fahrzeuge/published/{fahrzeuge}', [Frontend\Fahrzeuge\FahrzeugsController::class, 'published'])->name('fahrzeuge.published');
        Route::match(['PUT', 'PATCH'], 'fahrzeuge/photoPublished/{fahrzeuge}', [Frontend\Fahrzeuge\FahrzeugsController::class, 'photoPublished'])->name('fahrzeuge.photoPublished');

        // Antrag
        Route::get('/antrag', [Frontend\AntragController::class, 'index'])->name('antrag.index');
        Route::post('/antrag', [Frontend\AntragController::class, 'store'])->name('antrag.store');

        // Veranstaltungen
        Route::resource('/veranstaltungen', Frontend\Veranstaltungen\VeranstaltungensController::class);
        Route::match(['PUT', 'PATCH'], '/veranstaltungen/published/{veranstaltungen}', [Frontend\Veranstaltungen\VeranstaltungensController::class, 'published'])->name('veranstaltungen.published');

        // Gallery
        Route::resource('galerie', Frontend\Album\AlbumsController::class);
        Route::resource('galerie/photos', Frontend\Album\PhotosController::class);
        Route::match(['PUT', 'PATCH'], 'galerie/photos/preview/{photo:id}', [Frontend\Album\PhotosController::class, 'updatePreview'])->name('albums.update-preview');

        // Kontakt
        Route::resource('/kontakt', Frontend\KontaktsController::class)->only('index', 'store');

        // Gästebuch
        Route::resource('/gaestebuch', Frontend\Gaestebuch\GaestebuchesController::class)->only('index', 'store', 'update', 'destroy');

        // Impressum
        Route::get('/impressum', [Frontend\IndexController::class, 'impressum'])->name('impressum');
        Route::get('/datenschutz', [Frontend\IndexController::class, 'datenschutz'])->name('datenschutz');
    });

    // Interne/AdminRoute
    Route::middleware(['auth'])->group(function () {
        // Intern
        Route::name('intern.')->prefix('intern')->namespace('Intern')->group(function () {
            // Dashboard
            Route::get('/dashboard', [Intern\Dashboard\DashboardController::class, 'index'])->name('dashboard.index');
            Route::match(['PUT', 'PATCH'], 'change-password', [Intern\Dashboard\DashboardController::class, 'updatePassword'])->name('dashboard.update-password');

            // Album veröffentlichen
            Route::match(['PUT', 'PATCH'], '/galerie/published/{galerie}', [Frontend\Album\AlbumsController::class, 'published'])->name('galerie.published-galerie');

            // Fotos löschen
            Route::delete('/galerie/photos/destroy/{galerie}', [Frontend\Album\PhotosController::class, 'destroyPhoto'])->name('galerie.photos.destroy-photo');

            // Geburtstagsliste
            Route::get('geburtstagsliste', [Intern\PDF\PDFController::class, 'geburtstagsliste'])->name('pdf.geburtstagsliste');

            // Telefonliste
            Route::get('telefonliste', [Intern\PDF\PDFController::class, 'telefonliste'])->name('pdf.telefonliste');

            // Satzung
            Route::get('satzung', [Intern\PDF\PDFController::class, 'satzung'])->name('pdf.satzung');

            // Kalender
            Route::resource('kalender', Intern\Kalender\KalendersController::class);
            Route::post('kalender/versammlung', [Intern\Kalender\KalendersController::class, 'storeEvent'])->name('kalender.versammlung');
            Route::match(['PUT', 'PATCH'], 'kalender/versammlung/{kalender}', [Intern\Kalender\KalendersController::class, 'updateEvent'])->name('kalender.versammlungUpdate');
            Route::match(['PUT', 'PATCH'], 'kalender/angenommen/{kalender}', [Intern\Kalender\KalendersController::class, 'assumed_meeting'])->name('kalenders.assumed_meeting');
            Route::match(['PUT', 'PATCH'], 'kalender/termin/{kalender}', [Intern\Kalender\KalendersController::class, 'updateTermin'])->name('kalender.update-termin');

            // User Online
            Route::get('status', [Intern\UserController::class, 'userOnlineStatus']);

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

                // Zahlungszuweisung
                Route::resource('/zahlungen', Admin\Team\TeamController::class);
                Route::get('/zahlungen/bezahlt/{zahlung}/bearbeitung', [Admin\Team\TeamController::class, 'editEuro'])->name('zahlungen.edit-euro');
                Route::match(['PUT', 'PATCH'], '/zahlungen/bezahlt/{zahlung}', [Admin\Team\TeamController::class, 'updateEuro'])->name('zahlungen.euro-update');
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
        Toastr::success('Sitemap wurde erfolgreich erstellt', 'Erfolgreich');
        return redirect(route('frontend.index'));
    });

    Route::get('/route-cache', function () {
        Artisan::call('route:cache');
        Toastr::success('Routes cache', 'Erfolgreich');
        return redirect(route('frontend.index'));
    });

    Route::get('/route-clear', function () {
        Artisan::call('route:clear');
        Toastr::success('Routes cache cleared', 'Erfolgreich');
        return redirect(route('frontend.index'));
    });
// Clear config cache
    Route::get('/config-cache', function () {
        Artisan::call('config:clear');
        Toastr::success('Config cache cleared', 'Erfolgreich');
        return redirect(route('frontend.index'));
    });
// Clear application cache
    Route::get('/cache-clear', function () {
        Artisan::call('cache:clear');
        Toastr::success('Application cache cleared', 'Erfolgreich');
        return redirect(route('frontend.index'));
    });
// Clear view cache
    Route::get('/view-clear', function () {
        Artisan::call('view:clear');
        Toastr::success('View cache cleared', 'Erfolgreich');
        return redirect(route('frontend.index'));
    });
// Clear cache using reoptimized class
    Route::get('/optimize-clear', function () {
        Artisan::call('optimize:clear');
        Toastr::success('View cache cleared', 'Erfolgreich');
        return redirect(route('frontend.index'));
    });
});

Route::get('/offline', function () {
    return view('laravelpwa::offline');
});
