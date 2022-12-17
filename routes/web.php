<?php

use App\Http\Controllers\Auth\MyWelcomeController;
use App\Http\Controllers\Frontend;
use App\Http\Controllers\Intern;
use App\Http\Controllers\Intern\Admin;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Activitylog\Models\Activity;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Spatie\WelcomeNotification\WelcomesNewUsers;
use Illuminate\Http\Request;
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

Route::get('/testen', function (\Illuminate\Http\Request $request) {
    $kalender = \App\Models\Intern\Kalender\Kalender::where('von', '>', now())->get();
    foreach ($kalender as $kalenderID) {
        $assumed = \App\Models\Intern\Kalender\Assumed_Meeting::where('kalender_id', '=', $kalenderID->id)
            ->join('kalenders', 'kalenders.id', '=', 'assumed_meeting.kalender_id')
            ->select('kalenders.*', 'assumed_meeting.team_id', 'assumed_meeting.*', 'kalenders.created_at', 'kalenders.updated_at')
            ->get();
    }
    foreach ($assumed as $value) {
        $teams = \App\Models\Frontend\Team\Team::where('id', $value->team_id)->first();
        $dateVon = Carbon\Carbon::parse($value->von)->format('Y-m-d');
        $dateBis = Carbon\Carbon::parse($value->bis)->format('Y-m-d');
        $limit = Carbon\Carbon::parse($dateVon)->subDay($value->memory);
        $delete = Carbon\Carbon::parse($dateBis)->subDay($value->memory - 1);
        $dateTrue = Carbon\Carbon::parse($limit) == Carbon\Carbon::parse(today());
        $deleteTrue = Carbon\Carbon::parse($delete) == Carbon\Carbon::parse(today());
        $kalenders = $value;
        $kalenders->teams = $teams;
        $kalenders->vorname = $teams->vorname;
        $kalenders->adresse = explode(', ', $kalenders->eigenesFZ)[1] . ',' . explode(',', $kalenders->eigenesFZ)[2];
        if ($dateTrue) {
            Mail::to($kalenders->email)->send(new \App\Mail\Kalender\VersammlungsErinnerungsMail($kalenders));
        }
        if ($deleteTrue) {
            $value->delete();
        }
    }
//        dd($value, $team, $limit, $kalenders);
//    $kalenders = DB::table('dev_ttf.kalenders')
////        ->join('kalender_team', 'kalender_team.kalender_id', '=', 'kalenders.id')
//        ->join('kalenders_kalendertype', 'kalenders_kalendertype.kalender_id', '=', 'kalenders.id')
//        ->join('kalendertype', 'kalenders_kalendertype.kalender_type_id', '=', 'kalendertype.id')
//        ->where('kalenders.von', '>', $limit)
//        ->where('kalenders.published', true)
//        ->where('kalendertype.typeColor', '=', 'ver')
//        ->first();
//    $kalenders->cpUserTeam = App\Models\Frontend\Team\Team::where('id', $kalenders->cp_user_id)->select('vorname', 'nachname', 'email')->first();
//    $kalenders->userTeam = App\Models\Frontend\Team\Team::where('published', true)->select('id', 'vorname', 'nachname', 'email')->get();

//    dd($kalenders);
/*    foreach ($kalenders->userTeam as $userTeam) {
        $kalenders->vorname = $userTeam->vorname;
        $kalenders->nachname = $userTeam->nachname;
        $kalenders->email = $userTeam->email;
        $kalenders->team_id = $userTeam->id;
        $assumed_meeting = \App\Models\Intern\Kalender\Assumed_Meeting::where('kalender_id', '=', $kalenders->kalender_id)->where('team_id', '=', $userTeam->id)->get();
        $kalenders->assumed_meeting = $assumed_meeting;
//        Mail::to($userTeam->email)->send(new \App\Mail\Kalender\VersammlungsErinnerungsMail($kalenders));
    }*/
//    dd($kalenders);
    return view('emails.kalender.versammlungsErinnerungs', compact( 'kalenders'));
});

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
        Toastr::success('Sitemap wurde erfolgreich erstellt', 'Erfolgreich');
        return redirect(route('frontend.index'));
    });

    Route::get('/route-cache', function () {
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
