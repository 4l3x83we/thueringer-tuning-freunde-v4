<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: FahrzeugsController.php
 * User: ${USER}
 * Date: 1.${MONTH_NAME_FULL}.2022
 * Time: 7:58
 */

namespace App\Http\Controllers\Frontend\Fahrzeuge;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Mail\Fahrzeuge\FahrzeugHinzugefuegtMail;
use App\Models\Frontend\Album\Album;
use App\Models\Frontend\Album\Photo;
use App\Models\Frontend\Fahrzeuge\Fahrzeug;
use App\Models\Frontend\Team\Team;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;
use Str;
use Yoeunes\Toastr\Facades\Toastr;

class FahrzeugsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:write|edit|destroy')->only(['store']);
        $this->middleware('permission:write')->only(['create','store']);
        $this->middleware('permission:edit')->only(['edit','update']);
        $this->middleware('permission:destroy')->only('destroy');
    }

    public function index()
    {
        $fahrzeuges = Fahrzeug::where('published', true)->orderBy('updated_at', 'DESC')->paginate(12);
        foreach ($fahrzeuges as $fahrzeuge) {
            $thumbnail_ID = Album::where('id', $fahrzeuge->album_id)->get();
            foreach ($thumbnail_ID as $thumbnailID) {
                $previewImages[$fahrzeuge->id] = Photo::where('id', $thumbnailID->thumbnail_id)->first();
            }
        }
        $preview = $previewImages;
        return view('frontend.component.fahrzeuge.index', compact('fahrzeuges', 'preview'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategorie' => 'required',
            'fahrzeug' => 'required|max:255',
            'baujahr' => 'required|max:15',
            'motor' => 'required|max:65535',
            'besonderheiten' => 'max:65535',
            'karosserie' => 'max:65535',
            'felgen' => 'max:65535',
            'bremsen' => 'max:65535',
            'innenraum' => 'max:65535',
            'anlage' => 'max:65535',
            'beschreibungFz' => 'required|min:25|max:4294967295',
        ], [
            'beschreibungFz.required' => 'Beschreibung muss ausgefüllt werden mit mindestens 25 Zeichen.',
            'beschreibungFz.min' => 'Beschreibung muss mindestens 25 Zeichen lang sein.',
        ]);

        if ($validator->fails()) {
            return redirect(route('frontend.fahrzeuge.index'))->withErrors($validator)->withInput();
        }

        $user_id = auth()->user()->id;
        $team_id = Team::where('user_id', $user_id)->first()->id;
        $slug = SlugService::createSlug(Fahrzeug::class, 'slug', $request->fahrzeug);
        $kategorie = $request->kategorie ?: 'Fahrzeuge';
        $fullName = Helpers::replaceStrToLower(auth()->user()->name);
        $path = 'images/' . $fullName . '/' . $kategorie . '/' . $slug;
        $photos = Helpers::imageUploadWithThumbnailMultiple($request, 'images', $path);
        $fileSize = Helpers::allFileSize($path);

        $fahrzeuge = new Fahrzeug();
        $fahrzeuge->user_id = $user_id;
        $fahrzeuge->team_id = $team_id;
        $fahrzeuge->title = $request->fahrzeug;
        $fahrzeuge->slug = $slug;
        $this->updateFahrzeug($request, $fahrzeuge);
        if (auth()->user()->hasAnyRole('super_admin', 'admin')) {
            $fahrzeuge->published = 1;
            $fahrzeuge->published_at = now();
            Toastr::info('Dein Fahrzeug wurde angelegt.', 'Erfolgreich');
        }
        $fahrzeuge->description = $request->beschreibungFz;
        $fahrzeuge->path = $path;
        $fahrzeuge->save();

        $album = new Album();
        $album->user_id = $user_id;
        $album->title = $request->fahrzeug;
        $album->slug = $slug;
        $album->size = $fileSize;
        $album->description = Str::limit(strip_tags($request->beschreibungFz), 200);
        $album->kategorie = $kategorie;
        $album->path = $path;
        if (auth()->user()->hasAnyRole('super_admin', 'admin')) {
            $album->published = 1;
            $album->published_at = now();
            Toastr::info('Dein Album zum Fahrzeug: '. $fahrzeuge->title .' wurde angelegt.', 'Erfolgreich');
        }
        $album->save();

        if ($request->hasFile('images')) {
            if (count($request->file('images')) > 0) {
                foreach ($request->file('images') as $item => $v) {
                    Photo::insert([
                        'album_id' => $album->id,
                        'user_id' => $user_id,
                        'title' => $request->fahrzeug,
                        'slug' => $slug,
                        'size' => $photos['size'][$item],
                        'images' => $photos['data'][$item],
                        'images_thumbnail' => $photos['dataThumbnail'][$item],
                        'description' => Str::limit(strip_tags($request->beschreibungFz), 200),
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]);
                }
            }
        } else {
            Photo::insert([
                'album_id' => $album->id,
                'user_id' => $user_id,
                'title' => $request->fahrzeug,
                'slug' => $slug,
                'size' => $photos['size'],
                'images' => $photos['data'],
                'images_thumbnail' => $photos['dataThumbnail'],
                'description' => Str::limit(strip_tags($request->beschreibungFz), 200),
                'updated_at' => now(),
                'created_at' => now(),
            ]);
        }

        $photosNew = Photo::where('album_id', $album->id)->get();
        if (auth()->user()->hasAnyRole('super_admin', 'admin')) {
            foreach ($photosNew as $photo) {
                Photo::where('id', $photo->id)->update([
                    'published' => 1,
                    'published_at' => now(),
                ]);
            }
        }
        foreach ($photosNew as $photo) {
            Photo::where('id', $photo->id)->update([
                'fahrzeug_id' => $fahrzeuge->id,
            ]);
        }
        $photoPreview = Photo::where('album_id', $album->id)->inRandomOrder()->first();
        Album::where('id', $album->id)->update([
            'fahrzeug_id' => $fahrzeuge->id,
            'thumbnail_id' => $photoPreview->id,
        ]);
        Fahrzeug::where('id', $fahrzeuge->id)->update([
            'album_id' => $album->id,
        ]);

        if (!auth()->user()->hasAnyRole('super_admin', 'admin')) {
            Mail::to(env('TTF_EMAIL'))->send(new FahrzeugHinzugefuegtMail($fahrzeuge));
            Toastr::warning('Dein Fahrzeug wurde angelegt und wird durch einen Admin geprüft!', 'In Prüfung');
        }
        return redirect(route('frontend.fahrzeuge.index'));
    }

    public function show(Fahrzeug $fahrzeuge)
    {
        $album = Album::where('fahrzeug_id', $fahrzeuge->id)->first();
        $photos = Photo::where('fahrzeug_id', $fahrzeuge->id)->get();
        $published = Photo::where('fahrzeug_id', $fahrzeuge->id)->where('published', false)->count();
        $team = Team::where('user_id', $fahrzeuge->user_id)->first();

        $preview = '';
        foreach ($photos as $photo) {
            $preview = Photo::where('id', $album->thumbnail_id)->first();
        }

        $fahrzeuge->previous = Helpers::previous('fahrzeuges', $fahrzeuge->id);
        $fahrzeuge->next = Helpers::next('fahrzeuges', $fahrzeuge->id);

        return view('frontend.component.fahrzeuge.show', compact('fahrzeuge', 'album', 'photos', 'team', 'preview', 'published'));
    }

    public function edit(Fahrzeug $fahrzeuge)
    {
        $photos = Photo::where('fahrzeug_id', $fahrzeuge->id)->get();
        $preview = '';
        foreach ($photos as $photo) {
            $preview = Photo::where('id', $fahrzeuge->albums->thumbnail_id)->first()->images;
        }
        return view('frontend.component.fahrzeuge.edit', compact('fahrzeuge', 'photos', 'preview'));
    }

    public function update(Request $request, Fahrzeug $fahrzeuge)
    {
        $validator = Validator::make($request->all(), [
            'fahrzeug' => 'required|max:255',
            'baujahr' => 'required|max:15',
            'motor' => 'required|max:65535',
            'besonderheiten' => 'max:65535',
            'karosserie' => 'max:65535',
            'felgen' => 'max:65535',
            'bremsen' => 'max:65535',
            'innenraum' => 'max:65535',
            'anlage' => 'max:65535',
            'beschreibungFz' => 'required|min:25|max:4294967295',
        ], [
            'beschreibungFz.required' => 'Beschreibung muss ausgefüllt werden mit mindestens 25 Zeichen.',
            'beschreibungFz.min' => 'Beschreibung muss mindestens 25 Zeichen lang sein.',
        ]);

        if ($validator->fails()) {
            return redirect(route('frontend.fahrzeuge.show', $fahrzeuge->slug))->withErrors($validator)->withInput();
        }

        $user = User::where('id', $fahrzeuge->user_id)->first();
        $userName = Helpers::replaceStrToLower($user->name);
        $album = $fahrzeuge->albums;
        $photos = $fahrzeuge->albums->photos;
        $slug = $fahrzeuge->title === $request->fahrzeug ? $fahrzeuge->slug : SlugService::createSlug(Fahrzeug::class, 'slug', $request->fahrzeug);
        $imagesDelete = $request->imagesDelete;

        // Fahrzeugfotos Löschen
        if (isset($imagesDelete)) {
            $photoCount = (count($imagesDelete) - 1);
            for ($i = 0; $i <= $photoCount; $i++) {
                $photo = $photos->where('id', $imagesDelete[$i])->first();
                if (File::exists($fahrzeuge->path)) {
                    File::delete($photo->images);
                    File::delete($photo->images_thumbnail);
                }
                $photo->delete();
                Toastr::error('Deine Bilder wurden gelöscht!', 'Gelöscht!');
            }
        }

        // Photos add
        if ($request->hasFile('images')) {
            $photos = Helpers::imageUploadWithThumbnailMultiple($request, 'images', $fahrzeuge->path);
            if (count($request->file('images')) > 0) {
                foreach ($request->file('images') as $item => $v) {
                    Photo::insert([
                        'album_id' => $fahrzeuge->album_id,
                        'fahrzeug_id' => $fahrzeuge->id,
                        'user_id' => auth()->user()->id,
                        'title' => $request->fahrzeug,
                        'slug' => $slug,
                        'size' => $photos['size'][$item],
                        'images' => $photos['data'][$item],
                        'images_thumbnail' => $photos['dataThumbnail'][$item],
                        'description' => Str::limit(strip_tags($album->description), 200),
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]);
                    Toastr::warning('Deine Bilder wurden erfolgreich hochgeladen und werden nun geprüft!', 'Erfolgreich!');
                }
            }
        }

        // Kategorie ändern oder Fahrzeugtitel ändern oder beides ändern.
        if ($request->kategorie !== $album->kategorie) {
            $categoryFolder = explode('/', $album->path);
            $newPathCategory = $categoryFolder[0] . '/' . $userName . '/' . $request->kategorie . '/' . $categoryFolder[3];
            File::copyDirectory($album->path, $newPathCategory);
            File::deleteDirectory($album->path);
            Fahrzeug::where('id', '=', $fahrzeuge->id)->update([
                'path' => $newPathCategory,
                'updated_at' => now(),
            ]);
            Album::where('id', '=', $album->id)->update([
                'kategorie' => $request->kategorie,
                'path' => $newPathCategory,
                'updated_at' => now(),
            ]);
            Toastr::info('Kategorie wurde geändert', 'Geändert!');
        } elseif ($request->fahrzeug !== $fahrzeuge->title) {
            $categoryFolder = explode('/', $album->path);
            $newPathCategory = $categoryFolder[0] . '/' . $userName . '/' . $request->kategorie . '/' . $slug;
            File::copyDirectory($album->path, $newPathCategory);
            File::deleteDirectory($album->path);
            for ($i = 0; $i <= count($photos) - 1; $i++) {
                Photo::where('id', '=', $photos[$i]->id)->update([
                    'title' => $request->fahrzeug,
                    'slug' => $slug,
                    'updated_at' => now(),
                ]);
            }
            Fahrzeug::where('id', '=', $fahrzeuge->id)->update([
                'title' => $request->fahrzeug,
                'slug' => $slug,
                'path' => $newPathCategory,
                'updated_at' => now(),
            ]);
            Album::where('id', '=', $album->id)->update([
                'title' => $request->fahrzeug,
                'slug' => $slug,
                'kategorie' => $request->kategorie,
                'path' => $newPathCategory,
                'updated_at' => now(),
            ]);
            Toastr::info('Fahrzeugname wurde geändert', 'Geändert!');
        }

        // Update Fahrzeug
        $this->updateFahrzeug($request, $fahrzeuge);
        $fahrzeuge->description = $request->beschreibungFz;
        $fahrzeuge->save();

        Toastr::success('Änderungen wurden erfolgreich übernommen.', 'Erfolgreich!');
        return redirect(route('frontend.fahrzeuge.index'));
    }

    public function unpublished(Request $request, Fahrzeug $fahrzeuge)
    {
        $fahrzeuge->published = 0;
        Album::where('id', $fahrzeuge->album_id)->update(['published' => 0, 'updated_at' => now()]);
        Photo::where('album_id', $fahrzeuge->album_id)->update(['published' => 0, 'updated_at' => now()]);
        $fahrzeuge->save();

        Toastr::error('Fahrzeug wurde ausgeblendet!', 'Deaktiviert!');
        return redirect(route('frontend.fahrzeuge.show', $fahrzeuge->slug));
    }

    public function published(Request $request, Fahrzeug $fahrzeuge)
    {
        $published_at = $fahrzeuge->published_at ?: now();
        $fahrzeuge->published = 1;
        $fahrzeuge->published_at = $published_at;
        $fahrzeuge->updated_at = now();
        Album::where('id', $fahrzeuge->album_id)->update(['published' => 1, 'published_at' => $published_at, 'updated_at' => now()]);
        Photo::where('album_id', $fahrzeuge->album_id)->update(['published' => 1, 'published_at' => $published_at, 'updated_at' => now()]);
        $fahrzeuge->save();

        Toastr::success('Fahrzeug wurde veröffentlicht!', 'Veröffentlicht!');
        return redirect(route('frontend.fahrzeuge.show', $fahrzeuge->slug));
    }

    public function photoPublished(Request $request, Fahrzeug $fahrzeuge)
    {
        $photos = Photo::where('album_id', $fahrzeuge->album_id)->where('published', false)->get();
        foreach ($photos as $photo) {
            Photo::where('id', $photo->id)->update([
                'published' => 1,
                'published_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Toastr::success('Fotos wurden veröffentlicht!', 'Veröffentlicht!');
        return redirect(route('frontend.fahrzeuge.show', $fahrzeuge->slug));
    }

    public function destroy(Request $request, Fahrzeug $fahrzeuge)
    {
        Album::where('id', $fahrzeuge->album_id)->delete();
        if (File::exists($fahrzeuge->path)) {
            File::deleteDirectory($fahrzeuge->path);
        }
        $fahrzeuge->delete();

        Toastr::error('Fahrzeug würde endgültig gelöscht.', 'Gelöscht!');
        return redirect(route('frontend.fahrzeuge.index'));
    }

    /**
     * @param Request $request
     * @param Fahrzeug $fahrzeuge
     * @return void
     */
    public function updateFahrzeug(Request $request, Fahrzeug $fahrzeuge): void
    {
        $fahrzeuge->baujahr = $request->baujahr;
        $fahrzeuge->besonderheiten = (!$request->besonderheiten ? 'Keine' : $request->besonderheiten);
        $fahrzeuge->motor = $request->motor;
        $fahrzeuge->karosserie = (!$request->karosserie ? '<p>Serienmäßig keine Änderungen vorgenommen.</p>' : $request->karosserie);
        $fahrzeuge->felgen = (!$request->felgen ? '<p>Serienmäßig keine Änderungen vorgenommen.</p>' : $request->felgen);
        $fahrzeuge->fahrwerk = (!$request->fahrwerk ? '<p>Serienmäßig keine Änderungen vorgenommen.</p>' : $request->fahrwerk);
        $fahrzeuge->bremsen = (!$request->bremsen ? '<p>Serienmäßig keine Änderungen vorgenommen.</p>' : $request->bremsen);
        $fahrzeuge->innenraum = (!$request->innenraum ? '<p>Serienmäßig keine Änderungen vorgenommen.</p>' : $request->innenraum);
        $fahrzeuge->anlage = (!$request->anlage ? '<p>Serienmäßig keine Änderungen vorgenommen.</p>' : $request->anlage);
    }
}
