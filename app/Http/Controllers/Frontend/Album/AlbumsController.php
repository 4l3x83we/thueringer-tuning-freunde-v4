<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: AlbumsController.php
 * User: ${USER}
 * Date: 1.${MONTH_NAME_FULL}.2022
 * Time: 7:56
 */

namespace App\Http\Controllers\Frontend\Album;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Frontend\Album\Album;
use App\Models\Frontend\Album\Photo;
use App\Models\Frontend\Fahrzeuge\Fahrzeug;
use App\Models\Frontend\Team\Team;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Str;
use Yoeunes\Toastr\Facades\Toastr;

class AlbumsController extends Controller
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
        $albums = Album::where('published', true)->orderBy('published_at', 'DESC')->paginate(21);
        $albums->kategorie = Album::where('published', true)->select('kategorie')->groupBy('kategorie')->get();
        $albums->photos = Photo::where('published', true)->count();
        $preview = null;
        foreach ($albums as $album) {
            foreach(Photo::where('id', $album->thumbnail_id)->get() as $thumbnail) {
                $preview[$album->id] = $album->path.'/'.$thumbnail->images_thumbnail;
            }
        }
        return view('frontend.component.galerie', compact('albums', 'preview'));
    }

    public function create()
    {
        return view('frontend.component.galerie.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'kategorie' => 'required',
            'description' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return redirect(route('frontend.galerie.index'))->withErrors($validator)->withInput();
        }

        $slug = SlugService::createSlug(Album::class, 'slug', $request->title);
        $path = 'images/' . Helpers::replaceStrToLower(auth()->user()->name) . '/' . Helpers::replaceBlank($request->kategorie) . '/' . $slug;
        $photoUpload = Helpers::imageUploadWithThumbnailMultiple($request, 'images', $path);
        $fileSize = Helpers::allFileSize($path);
        $published = $request->published ? true : false;
        $published_at = $request->published_at ? now() : null;

        $album = new Album();
        $album->user_id = auth()->user()->id;
        $album->title = $request->title;
        $album->slug = $slug;
        $album->size = $fileSize;
        $album->description = Str::limit(strip_tags($request->description), 200);
        $album->kategorie = Helpers::replaceBlank($request->kategorie);
        $album->path = $path;
        $album->published = $published;
        $album->published_at = $published_at;
        $album->updated_at = now();
        $album->created_at = now();
        $album->save();

        // Images Upload
        if ($request->hasFile('images')) {
            if (count($request->images) > 0) {
                foreach ($request->images as $item => $v) {
                    Photo::insert([
                        'album_id' => $album->id,
                        'user_id' => auth()->user()->id,
                        'title' => $album->title,
                        'slug' => $slug,
                        'size' => $photoUpload['size'][$item],
                        'images' => $photoUpload['data'][$item],
                        'images_thumbnail' => $photoUpload['dataThumbnail'][$item],
                        'description' => Str::limit(strip_tags($album->description), 200),
                        'published' => $published,
                        'published_at' => $published_at,
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]);
                }
                Toastr::info('Die Fotos wurden dem Album ' . $album->title . ' erfolgreich hinzugefügt.', 'Erfolgreich!');
            } else {
                Photo::insert([
                    'album_id' => $album->id,
                    'user_id' => auth()->user()->id,
                    'title' => $album->title,
                    'slug' => $slug,
                    'size' => $photoUpload['size'],
                    'images' => $photoUpload['data'],
                    'images_thumbnail' => $photoUpload['dataThumbnail'],
                    'description' => Str::limit(strip_tags($album->description), 200),
                    'published' => $published,
                    'published_at' => $published_at,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]);
                Toastr::info('Das Fotos wurden dem Album ' . $album->title . ' erfolgreich hinzugefügt.', 'Erfolgreich!');
            }
        }

        $thumbnailID = Photo::where('album_id', $album->id)->inRandomOrder()->first()->id;
        Album::where('id', $album->id)->update([
            'thumbnail_id' => $thumbnailID
        ]);
        Toastr::success('Das Album mit dem Titel: "' . $album->title . '" wurde angelegt.', 'Erfolgreich!');
        return redirect(route('frontend.galerie.show', $album->slug));
    }

    public function show(Album $galerie)
    {
        $photos = Photo::where('album_id', $galerie->id)->get();
        $team = Team::where('user_id', $galerie->user_id)->first();
        $galerie->userName = $team->title;
        $galerie->fullName = Helpers::replaceStrToLower($team->vorname . ' ' . $team->nachname);
        $galerie->photoCount = Photo::where('album_id', $galerie->id)->where('published', true)->count();
        $galerie->photos = $photos;
        $galerie->pathUsername = explode('/', $galerie->images);
        return view('frontend.component.galerie.show', compact('galerie'));
    }

    public function edit(Album $galerie)
    {
        $photos = Photo::where('album_id', $galerie->id)->get();
        return view('frontend.component.galerie.edit', compact('galerie', 'photos'));
    }

    public function update(Request $request, Album $galerie)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'kategorie' => 'required',
            'description' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return redirect(route('frontend.galerie.show', $galerie->slug))->withErrors($validator)->withInput();
        }

        $slug = ($galerie->title === $request->title) ? $galerie->slug : SlugService::createSlug(Album::class, 'slug', $request->title);
        $photos = Photo::where('album_id', $galerie->id)->get();
        $user = Team::where('user_id', $galerie->user_id)->first();
        $fullName = Helpers::replaceStrToLower($user->vorname . ' ' . $user->nachname);
        $pathAlbumOld = $galerie->path;
        $photosUpload = Helpers::imageUploadWithThumbnailMultiple($request, 'images', $pathAlbumOld);
        $fahrzeugID = ($galerie->kategorie === 'Fahrzeuge' or $galerie->kategorie === 'Projekte') ? $galerie->fahrzeug_id : NULL;

        // Images Upload
        if ($request->hasFile('images')) {
            if (count($request->images) > 0) {
                foreach ($request->images as $item => $v) {
                    Photo::insert([
                        'album_id' => $galerie->id,
                        'user_id' => auth()->user()->id,
                        'fahrzeug_id' => $fahrzeugID,
                        'title' => $request->title,
                        'slug' => $slug,
                        'size' => $photosUpload['size'][$item],
                        'images' => $photosUpload['data'][$item],
                        'images_thumbnail' => $photosUpload['dataThumbnail'][$item],
                        'description' => Str::limit(strip_tags($request->description), 200),
                        'published' => $request->published ? true : false,
                        'published_at' => now(),
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]);
                }
                Toastr::info('Die Fotos wurden dem Album ' . $request->title . ' erfolgreich hinzugefügt.', 'Erfolgreich!');
            } else {
                Photo::insert([
                    'album_id' => $galerie->id,
                    'user_id' => auth()->user()->id,
                    'fahrzeug_id' => $fahrzeugID,
                    'title' => $request->title,
                    'slug' => $slug,
                    'size' => $photosUpload['size'],
                    'images' => $photosUpload['data'],
                    'images_thumbnail' => $photosUpload['dataThumbnail'],
                    'description' => Str::limit(strip_tags($request->description), 200),
                    'published' => $request->published ? true : false,
                    'published_at' => now(),
                    'updated_at' => now(),
                    'created_at' => now(),
                ]);
                Toastr::info('Das Fotos wurden dem Album ' . $request->title . ' erfolgreich hinzugefügt.', 'Erfolgreich!');
            }
        }

        // Category Change
        if ($galerie->kategorie !== $request->kategorie) {
            $photos = Photo::where('album_id', $galerie->id)->get();
            foreach ($photos as $photo) {
                $pathKategorie = explode('/', $galerie->path)[2];
                $pathSlug = explode('/', $galerie->path)[3];
                $pathAlbumOld = 'images/' . $fullName . '/' . $pathKategorie . '/' . $pathSlug;
                Photo::where('id', $photo->id)->update([
                    'images' => $photo->images,
                    'images_thumbnail' => $photo->images_thumbnail,
                    'published' => $request->published ? true : false,
                    'published_at' => $photo->published_at === null ? $photo->created_at : $photo->published_at,
                    'updated_at' => now(),
                ]);
            }
            $pathAlbumNewKat = 'images/' . $fullName . '/' . $request->kategorie . '/' . $slug;
            File::copyDirectory($pathAlbumOld,$pathAlbumNewKat);
            File::deleteDirectory($pathAlbumOld);
            $galerie->kategorie = $request->kategorie;
            $galerie->path = $pathAlbumNewKat;
            $galerie->updated_at = now();
            $galerie->save();
            Toastr::info('Kategorie wurde geändert und Fotos wurden verschoben.', 'Erfolgreich!');
        }

        // Category and Title Change
        if ($galerie->title !== $request->title) {
            $photos = Photo::where('album_id', $galerie->id)->get();
            foreach ($photos as $photo) {
                $pathTitle = explode('/', $galerie->path)[0];
                $pathUsername = explode('/', $galerie->path)[1];
                $pathKategorie = explode('/', $galerie->path)[2];
                $pathSlug = explode('/', $galerie->path)[3];
                $pathAlbumOld = 'images/' . $fullName . '/' . $pathKategorie . '/' . $pathSlug;
                Photo::where('id', $photo->id)->update([
                    'title' => $request->title,
                    'slug' => $slug,
                    'images' => $photo->images,
                    'images_thumbnail' => $photo->images_thumbnail,
                    'published' => $request->published ? true : false,
                    'published_at' => $photo->published_at === null ? $photo->created_at : $photo->published_at,
                    'updated_at' => now(),
                ]);
            }
            if ($galerie->kategorie === 'Fahrzeuge' or $galerie->kategorie === 'Projekte') {
                Fahrzeug::where('album_id', $galerie->id)->update([
                    'title' => $request->title,
                    'slug' => $slug,
                    'updated_at' => now(),
                ]);
            }
            $pathAlbumNewKatSlug = 'images/' . $fullName . '/' . $request->kategorie . '/' . $slug;
            File::copyDirectory($pathAlbumOld,$pathAlbumNewKatSlug);
            File::deleteDirectory($pathAlbumOld);
            $galerie->title = $request->title;
            $galerie->slug = $slug;
            $galerie->kategorie = $request->kategorie;
            $galerie->path = $pathAlbumNewKatSlug;
            $galerie->updated_at = now();
            $galerie->save();
            Toastr::info('Title wurde geändert und Fotos wurden verschoben.', 'Erfolgreich!');
        }

        $fileSize = Helpers::allFileSize($galerie->path);

        foreach ($photos as $photo) {
            if ($request->published) {
                Photo::where('id', $photo->id)->update([
                    'published' => true,
                ]);
            } else {
                Photo::where('id', $photo->id)->update([
                    'published' => false,
                ]);
            }
        }

        if ($galerie->size === $fileSize) { $size = $galerie->size; } else { $size = $fileSize; }

        $galerie->size = $size;
        $galerie->published = $request->published ? true : false;
        $galerie->published_at = $galerie->published_at === null ? $galerie->created_at : $galerie->published_at;
        $galerie->description = Str::limit(strip_tags($request->description), 255);
        $galerie->save();

        Toastr::success('Album wurde geändert!', 'Geändert!');
        return redirect(route('frontend.galerie.show', $galerie->slug));
    }

    public function destroy(Album $galerie)
    {
        if (File::exists($galerie->path)) {
            File::deleteDirectory($galerie->path);
        }
        $galerie->delete();
        Toastr::error('Die Galerie wurde endgültig gelöscht!', 'Gelöscht!');
        return redirect(route('frontend.galerie.index'));
    }

    public function published(Album $galerie)
    {
        $photos = Photo::where('album_id', $galerie->id)->get();

        if ($galerie->published) {
            Toastr::error('Dein Album ' . $galerie->title . ' wurde deaktiviert.', 'Deaktiviert');
        } else {
            Toastr::success('Dein Album ' . $galerie->title . ' wurde aktiviert.', 'aktiviert');
        }

        foreach ($photos as $photo) {
            if ($galerie->published) {
                Photo::where('id', $photo->id)->update([
                    'published' => false,
                ]);
            } else {
                Photo::where('id', $photo->id)->update([
                    'published' => true,
                ]);
            }
        }
        $galerie->published = $galerie->published ? false : true;
        $galerie->save();
        return redirect(route('intern.dashboard.index').'#galerie');
    }
}
