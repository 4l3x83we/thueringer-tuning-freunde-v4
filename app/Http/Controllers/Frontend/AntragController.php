<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: AntragController.php
 * User: ${USER}
 * Date: 30.${MONTH_NAME_FULL}.2022
 * Time: 11:40
 */

namespace App\Http\Controllers\Frontend;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Mail\Antrag\AntragEingangAdminMail;
use App\Mail\Antrag\AntragEingangMail;
use App\Mail\Antrag\AntragEntferntMail;
use App\Mail\Antrag\AntragGenehmigtClubMail;
use App\Mail\Antrag\AntragGenehmigtMail;
use App\Models\Frontend\Album\Album;
use App\Models\Frontend\Album\Photo;
use App\Models\Frontend\Fahrzeuge\Fahrzeug;
use App\Models\Frontend\Team\Team;
use App\Models\User;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use File;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mail;
use Yoeunes\Toastr\Facades\Toastr;

class AntragController extends Controller
{
    public function index()
    {
        return view('frontend.antrag');
    }

    public function indexAdmin()
    {
        $antrags = Team::orderBy('id', 'DESC')->get();
        return view('intern.admin.antrag.index', compact('antrags'));
    }

    public function store(Request $request)
    {
        if (!$request->fahrzeugvorhanden) {
            $validator = Validator::make($request->all(), [
                'anrede' => 'required',
                'vorname' => 'required|max:255',
                'nachname' => 'required|max:255',
                'straße' => 'required|max:255',
                'plz' => 'required|max:5',
                'ort' => 'required|max:255',
                'email' => 'required|max:255|email',
                'geburtsdatum' => 'required|max:255',
                'fahrzeug' => 'required|max:255',
                'baujahr' => 'required|max:15',
                'mobil' => 'required|max:15',
                'telefon' => 'max:15',
                'motor' => 'required|max:65535',
                'besonderheiten' => 'max:65535',
                'karosserie' => 'max:65535',
                'felgen' => 'max:65535',
                'bremsen' => 'max:65535',
                'innenraum' => 'max:65535',
                'anlage' => 'max:65535',
                'beruf' => 'max:255',
                'facebook' => 'max:255',
                'tiktok' => 'max:255',
                'instagram' => 'max:255',
                'description' => 'required|min:250|max:4294967295',
                'beschreibungFz' => 'required|min:25|max:4294967295',
            ], [
                'description.required' => 'Beschreibung muss ausgefüllt werden mit mindestens 250 Zeichen.',
                'description.min' => 'Beschreibung muss mindestens 250 Zeichen lang sein.',
                'plz.required' => 'Postleitzahl muss ausgefüllt werden.',
                'ort.required' => 'Wohnort muss ausgefüllt werden.',
                'mobil.required' => 'Mobilfunk muss ausgefüllt werden.',
                'email.required' => 'E-Mail Adresse muss ausgefüllt werden.',
                'beschreibungFz.required' => 'Beschreibung muss ausgefüllt werden mit mindestens 25 Zeichen.',
                'beschreibungFz.min' => 'Beschreibung muss mindestens 25 Zeichen lang sein.',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'anrede' => 'required',
                'vorname' => 'required|max:255',
                'nachname' => 'required|max:255',
                'straße' => 'required|max:255',
                'plz' => 'required|max:5',
                'ort' => 'required|max:255',
                'email' => 'required|max:255|email',
                'geburtsdatum' => 'required|max:255',
                'mobil' => 'required|max:15',
                'telefon' => 'max:15',
                'beruf' => 'max:255',
                'facebook' => 'max:255',
                'tiktok' => 'max:255',
                'instagram' => 'max:255',
                'description' => 'required|min:250|max:4294967295',
            ], [
                'description.required' => 'Beschreibung muss ausgefüllt werden mit mindestens 250 Zeichen.',
                'description.min' => 'Beschreibung muss mindestens 250 Zeichen lang sein.',
                'plz.required' => 'Postleitzahl muss ausgefüllt werden.',
                'ort.required' => 'Wohnort muss ausgefüllt werden.',
                'mobil.required' => 'Mobilfunk muss ausgefüllt werden.',
                'email.required' => 'E-Mail Adresse muss ausgefüllt werden.',
            ]);
        }

        if ($validator->fails()) {
            return redirect(route('frontend.antrag.index'))->withErrors($validator)->withInput();
        }

        $anrede = !$request->anrede ? 'keine Angabe' : $request->anrede;
        $teamMitglied = Helpers::replaceStrToLower($request->vorname .'-'. $request->nachname);
        $beruf = !$request->beruf ? 'Keinen' : $request->beruf;
        $besonderheiten = !$request->besonderheiten ? 'Keine' : $request->besonderheiten;
        $karosserie = !$request->karosserie ? '<p>Serienmäßig keine Änderungen vorgenommen.</p>' : $request->karosserie;
        $fahrwerk = !$request->fahrwerk ? '<p>Serienmäßig keine Änderungen vorgenommen.</p>' : $request->fahrwerk;
        $felgen = !$request->felgen ? '<p>Serienmäßig keine Änderungen vorgenommen.</p>' : $request->felgen;
        $bremsen = !$request->bremsen ? '<p>Serienmäßig keine Änderungen vorgenommen.</p>' : $request->bremsen;
        $innenraum = !$request->innenraum ? '<p>Serienmäßig keine Änderungen vorgenommen.</p>' : $request->innenraum;
        $anlage = !$request->anlage ? '<p>Serienmäßig keine Änderungen vorgenommen.</p>' : $request->anlage;
        $profilPath = 'images/' . $teamMitglied . '/profil';
        $profilImage = Helpers::imageUpload($request, 'profilbild', $profilPath);

        if (!$request->fahrzeugvorhanden) {
            $title = $request->fahrzeug;
            $slug = SlugService::createSlug(Fahrzeug::class, 'slug', $title);
            $published_at = Carbon::parse(now())->toDateTimeLocalString();
            $kategorie = 'Fahrzeuge';
            $path = 'images/' . $teamMitglied . '/' . $kategorie . '/' . $slug;

            $image = Helpers::imageUploadWithThumbnailMultiple($request, 'images', $path);
            $fileSize = Helpers::allFileSize($path);

            if (!empty($request->hasFile('images'))) {
                $album = new Album();
                $album->user_id = null;
                $album->title = $title;
                $album->slug = $slug;
                $album->kategorie = $kategorie;
                $album->size = $fileSize;
                $album->description = Str::limit(strip_tags($request->description), 200);
                $album->published = 0;
                $album->published_at = NULL;
                $album->save();
            }

            if ($request->images) {
                if (count($request->images) > 0) {
                    foreach ($request->images as $item => $v) {
                        $photos = [
                            'album_id' => $album->id,
                            'user_id' => null,
                            'fahrzeug_id' => null,
                            'title' => $title,
                            'slug'=> $slug,
                            'size' => $image['size'][$item],
                            'images' => $image['data'][$item],
                            'images_thumbnail' => $image['dataThumbnail'][$item],
                            'description' => Str::limit(strip_tags($title), 200),
                            'published' => 0,
                            'updated_at' => now(),
                            'created_at' => now(),
                        ];
                        Photo::insert($photos);
                    }
                }
            }

            $thumbnailID = Photo::where('album_id', $album->id)->inRandomOrder()->first()->id;

            $fahrzeuge = new Fahrzeug();
            if (!empty($request->hasFile('images'))) {
                $fahrzeuge->album_id = $album->id;
            }
            $fahrzeuge->title = $title;
            $fahrzeuge->slug = $slug;
            $fahrzeuge->baujahr = $request->baujahr;
            $fahrzeuge->besonderheiten = $besonderheiten;
            $fahrzeuge->motor = $request->motor;
            $fahrzeuge->karosserie = $karosserie;
            $fahrzeuge->felgen = $felgen;
            $fahrzeuge->fahrwerk = $fahrwerk;
            $fahrzeuge->bremsen = $bremsen;
            $fahrzeuge->innenraum = $innenraum;
            $fahrzeuge->anlage = $anlage;
            $fahrzeuge->description = $request->beschreibungFz;
            $fahrzeuge->published = 0;
            $fahrzeuge->save();

            $team = new Team();
            $team->user_id = null;
            $team->fahrzeug_id = $fahrzeuge->id;
            $this->extracted($team, $teamMitglied, $anrede, $request, $beruf);
            $team->fahrzeug_vorhanden = 0;
            $team->path = $profilPath;
            $team->published = 0;
            $team->save();

            if (!empty($request->file('profilbild'))) {
                $teamPhoto = [
                    'album_id' => null,
                    'user_id' => null,
                    'fahrzeug_id' => null,
                    'team_id' => $team->id,
                    'title' => $request->vorname . ' ' . $request->nachname,
                    'slug'=> SlugService::createSlug(Team::class, 'slug', $teamMitglied),
                    'size' => Helpers::bytesToHuman($request->profilbild->getSize()),
                    'images' => $profilImage,
                    'published' => 0,
                    'updated_at' => now(),
                    'created_at' => now(),
                ];
                Photo::insert($teamPhoto);
            }

            Team::where('id', '=', $team->id)->update(['antrag_id' => $team->id, 'updated_at' => now()]);
            Fahrzeug::where('id', '=', $fahrzeuge->id)->update(['team_id' => $team->id, 'updated_at' => now()]);
            Album::where('id', '=', $album->id)->update(['fahrzeug_id' => $fahrzeuge->id, 'thumbnail_id' => $thumbnailID, 'updated_at' => now()]);
            Photo::where('album_id', '=', $album->id)->update(['fahrzeug_id' => $fahrzeuge->id, 'updated_at' => now()]);
            Photo::where('team_id', '=', $team->id)->update(['fahrzeug_id' => null, 'album_id' => null, 'updated_at' => now()]);
            Photo::where('id', '=', $thumbnailID)->update(['thumbnail' => 1, 'updated_at' => now()]);
            $team->fahrzeuge = Fahrzeug::where('team_id', '=', $team->id)->first();
            $team->photos = Photo::where('album_id', '=', $album->id)->get();
        } else {
            $team = new Team();
            $team->user_id = null;
            $team->fahrzeug_id = null;
            $this->extracted($team, $teamMitglied, $anrede, $request, $beruf);
            $team->fahrzeug_vorhanden = 1;
            $team->path = $profilPath;
            $team->published = 0;
            $team->save();

            if (!empty($request->file('profilbild'))) {
                $teamPhoto = [
                    'album_id' => null,
                    'user_id' => null,
                    'fahrzeug_id' => null,
                    'team_id' => $team->id,
                    'title' => $request->vorname . ' ' . $request->nachname,
                    'slug'=> SlugService::createSlug(Team::class, 'slug', $teamMitglied),
                    'size' => Helpers::bytesToHuman($request->profilbild->getSize()),
                    'images' => $profilImage,
                    'published' => 0,
                    'updated_at' => now(),
                    'created_at' => now(),
                ];
                Photo::insert($teamPhoto);
            }
        }

        $team->profilPhoto = Photo::where('team_id', '=', $team->id)->first()->images;
        $profilPhotoID = Photo::where('team_id', '=', $team->id)->first()->id;
        Team::where('id', '=', $team->id)->update(['photo_id' => $profilPhotoID, 'updated_at' => now()]);
        Mail::to($request->email)->send(new AntragEingangMail($team));
        Mail::to('info@thueringer-tuning-freunde.de')->send(new AntragEingangAdminMail($team));
        Toastr::success('Dein Antrag wurde erfolgreich versendet.', 'Erfolgreich!');
        return redirect(route('frontend.antrag.index'));
    }

    public function show($id)
    {
        $fahrzeuge = null;
        $antrag = Team::findOrFail($id);
        if (!$antrag->fahrzeug_vorhanden) {
            foreach ($antrag->fahrzeuges as  $fahrzeuge) {
                $antrag->fahrzeuge = $fahrzeuge;
            }
            $album = Album::where('fahrzeug_id', $fahrzeuge->id)->first();
            $antrag->photos = Photo::where('album_id', $album->id)->get();
            $antrag->fzPath = $album->path;
        }
        $antrag->gebdatum = Carbon::parse($antrag->geburtsdatum)->age;
        if (!empty($antrag->path)) {
            $antrag->image = $antrag->path . '/' . Photo::where('team_id', $antrag->id)->first()->images;
        }

        return view('intern.admin.antrag.show', compact('antrag'));
    }

    public function checked(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('intern.admin.antrag.show', $id))->withErrors($validator)->withInput();
        }

        $antrag = Team::findOrFail($id);
        if (!$antrag->fahrzeug_vorhanden) {
            $antrag->fahrzeuge = $antrag->fahrzeuges->first();
            $antrag->photos = $antrag->photosFahrzeuge;
            $antrag->photoProfil = $antrag->photosProfil->first();
        }

        $title = $request->title;
        $slug = SlugService::createSlug(Team::class, 'slug', $title);
        $is_checked = $request->is_checked;
        $published_at = Carbon::parse($request->published_at)->toDateTimeString();
        $password = Helpers::passwort_generate(10);

        $user = User::create([
            'name' => $antrag->vorname . ' ' . $antrag->nachname,
            'email' => $antrag->email,
            'password' => Hash::make($password),
//            'is_checked' => $is_checked,
        ]);

        $user->assignRole([2]);

        Team::where('id', '=', $antrag->id)->update([
            'published' => 1,
            'title' => $title,
            'slug' => $slug,
            'funktion' => $request->funktion,
            'user_id' => $user->id,
            'updated_at' => now(),
            'published_at' => $published_at,
        ]);

        if (!$antrag->fahrzeug_vorhanden) {
            Album::where('id', '=', $antrag->fahrzeuge->album_id)->update([
                'user_id' => $user->id,
                'published' => 1,
                'published_at' => $published_at,
                'updated_at' => now(),
            ]);

            Photo::where('album_id', '=', $antrag->fahrzeuge->album_id)->update([
                'user_id' => $user->id,
                'published' => 1,
                'published_at' => $published_at,
                'updated_at' => now(),
            ]);

            Fahrzeug::where('id', '=', $antrag->fahrzeug_id)->update([
                'user_id' => $user->id,
                'published' => 1,
                'published_at' => $published_at,
                'updated_at' => now(),
            ]);
        }

        if ($antrag->photo_id) {
            Photo::where('id', '=', $antrag->photo_id)->update([
                'user_id' => $user->id,
                'published' => 1,
                'published_at' => $published_at,
                'updated_at' => now(),
            ]);
        }

        $antrag->userEmail = $user->email;
        $antrag->passwort = $password;
        $antrag->slug = $slug;

        Mail::to($antrag->email)->send(new AntragGenehmigtMail($antrag));
        Mail::to('club@thueringer-tuning-freunde.de')->send(new AntragGenehmigtClubMail($antrag));

        $expiresAt = now()->addDays(7);
        $user->sendWelcomeNotification($expiresAt);

        Toastr::success('Antrag wurde genehmigt', 'Erfolgreich');
        return redirect()->route('intern.admin.antrag.index');
    }

    public function revoke(Request $request, $id)
    {
        $antrag = Team::findOrFail($id);
        $antrag->fahrzeuge = Fahrzeug::where('team_id', $id)->first();
        $antrag->photos = Photo::where('album_id', $antrag->fahrzeuge->album_id)->get();
        $antrag->photoProfil = Photo::where('id', $antrag->photo_id)->first();

        Team::where('antrag_id', $id)->update([
            'published' => 0,
            'title' => null,
            'slug' => null,
            'user_id' => null,
            'updated_at' => now(),
            'published_at' => null,
        ]);

        Fahrzeug::where('team_id', $id)->update([
            'published' => 0,
            'user_id' => null,
            'updated_at' => now(),
            'published_at' => null,
        ]);

        Album::where('id', $antrag->fahrzeuge->album_id)->update([
            'published' => 0,
            'user_id' => null,
            'updated_at' => now(),
            'published_at' => null,
        ]);

        Photo::where('album_id', $antrag->fahrzeuge->album_id)->update([
            'published' => 0,
            'user_id' => null,
            'updated_at' => now(),
            'published_at' => null,
        ]);

        Photo::where('id', $antrag->photo_id)->update([
            'published' => 0,
            'user_id' => null,
            'updated_at' => now(),
            'published_at' => null,
        ]);

        User::where('id', $antrag->user_id)->delete();

        Mail::to('club@thueringer-tuning-freunde.de')->send(new AntragEntferntMail($antrag));
        Toastr::success('Antrag wurde zurückgezogen', 'Erfolgreich');
        return redirect()->route('intern.admin.antrag.index');
    }

    public function destroy(Request $request, $id)
    {
        $team = Team::where('antrag_id', $id)->first();
        $team->fullname = Helpers::replaceStrToLower($team->vorname . ' ' . $team->nachname);
        Mail::to('club@thueringer-tuning-freunde.de')->send(new AntragEntferntMail($team));
        $team->path = 'images/'.$team->fullname;
        $team->fahrzeug = Fahrzeug::where('user_id', $team->user_id)->delete();

        // Delete all Alben
        $alben = Album::where('user_id', $team->user_id)->delete();
        if (File::exists($team->path)) {
            File::deleteDirectory($team->path);
        }
        if ($team->user_id) {
            User::where('id', $team->user_id)->delete();
        }
        $team->delete();
        Toastr::error('Das Mitglied wurde gelöscht!', 'Gelöscht!');
        return redirect(route('intern.admin.antrag.index'));
    }

    /**
     * @param Team $team
     * @param string $teamMitglied
     * @param mixed $anrede
     * @param Request $request
     * @param mixed $beruf
     * @return void
     */
    public function extracted(Team $team, string $teamMitglied, mixed $anrede, Request $request, mixed $beruf): void
    {
        $team->antrag_id = null;
        $team->slug = SlugService::createSlug(Team::class, 'slug', $teamMitglied);
        $team->anrede = $anrede;
        $team->vorname = $request->vorname;
        $team->nachname = $request->nachname;
        $team->straße = $request->straße;
        $team->plz = $request->plz;
        $team->wohnort = $request->ort;
        $team->telefon = $request->telefon;
        $team->mobil = $request->mobil;
        $team->email = $request->email;
        $team->geburtsdatum = $request->geburtsdatum;
        $team->beruf = $beruf;
        $team->description = $request->description;
        $team->tiktok = '@'.$request->tiktok;
        $team->instagram = $request->instagram;
        $team->facebook = $request->facebook;
        $team->funktion = null;
        $team->emailIntern = Helpers::replaceStrToLower($request->vorname . '.' . $request->nachname[0]) . '@thueringer-tuning-freunde.de';
        $team->ip_adresse = $request->getClientIp();
    }
}
