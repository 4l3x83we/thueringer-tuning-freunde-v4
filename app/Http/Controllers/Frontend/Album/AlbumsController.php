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
use App\Models\Frontend\Team\Team;
use Cviebrock\EloquentSluggable\Services\SlugService;
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
        foreach ($albums as $album) {
            foreach(Photo::where('id', $album->thumbnail_id)->get() as $thumbnail) {
                $albums->images_thumbnail[] = $thumbnail->images_thumbnail;
            }
        }
        return view('frontend.component.galerie', compact('albums'));
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
    }

    public function update(Request $request, Album $galerie)
    {
    }

    public function destroy(Album $galerie)
    {
    }
}
