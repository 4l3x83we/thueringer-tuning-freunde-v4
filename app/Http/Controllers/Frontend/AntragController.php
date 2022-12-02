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
use App\Models\Frontend\Album\Album;
use App\Models\Frontend\Album\Photo;
use App\Models\Frontend\Fahrzeuge\Fahrzeug;
use App\Models\Frontend\Team\Team;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mail;
use Yoeunes\Toastr\Facades\Toastr;

class AntragController extends Controller
{
    public function index()
    {
        return view('frontend.antrag');
    }

    public function store(Request $request)
    {
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
            $team->tiktok = $request->tiktok;
            $team->instagram = $request->instagram;
            $team->facebook = $request->facebook;
            $team->funktion = null;
            $team->emailIntern = Helpers::replaceStrToLower($request->vorname.'.'.$request->nachname[0]).'@thueringer-tuning-freunde.de';
            $team->ip_adresse = $request->getClientIp();
            $team->fahrzeug_vorhanden = 0;
            $team->published = 0;
            $team->save();

            if (!empty($request->file('profilbild'))) {
                $teamPhoto = [
                    'album_id' => $album->id,
                    'user_id' => null,
                    'fahrzeug_id' => null,
                    'team_id' => $team->id,
                    'title' => $request->vorname . ' ' . $request->nachname,
                    'slug'=> SlugService::createSlug(Team::class, 'slug', $teamMitglied),
                    'size' => Helpers::bytesToHuman($request->profilbild->getSize()),
                    'images' => $profilImage,
                    'images_thumbnail' => $profilImage,
                    'description' => Str::limit(strip_tags($request->description), 200),
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
            $team->tiktok = $request->tiktok;
            $team->instagram = $request->instagram;
            $team->facebook = $request->facebook;
            $team->funktion = null;
            $team->emailIntern = Helpers::replaceStrToLower($request->vorname.'.'.$request->nachname[0]).'@thueringer-tuning-freunde.de';
            $team->ip_adresse = $request->getClientIp();
            $team->fahrzeug_vorhanden = 1;
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
                    'images_thumbnail' => $profilImage,
                    'description' => Str::limit(strip_tags($request->description), 200),
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
}
