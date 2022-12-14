<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: PhotosController.php
 * User: ${USER}
 * Date: 1.${MONTH_NAME_FULL}.2022
 * Time: 7:57
 */

namespace App\Http\Controllers\Frontend\Album;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Frontend\Album\Album;
use App\Models\Frontend\Album\Photo;
use App\Models\Frontend\Team\Team;
use App\Models\User;
use File;
use Illuminate\Http\Request;
use Str;
use Yoeunes\Toastr\Facades\Toastr;

class PhotosController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $album = Album::where('id', $request->album_id)->first();
        $user = Helpers::replaceStrToLower(User::where('id', $album->user_id)->first()->name);
        $userRole = auth()->user()->hasAnyRole(['super_admin', 'admin']);
        $path = 'images/' . $user . '/' . $album->kategorie . '/' . $album->slug;
        $published = (bool)$userRole;
        $published_at = $userRole ? now() : null;
        $photosUpload = Helpers::imageUploadWithThumbnailMultiple($request, 'images', $path);

        // Images Upload
        if ($request->hasFile('images')) {
            if (count($request->images) > 0) {
                foreach ($request->images as $item => $v) {
                    Photo::insert([
                        'album_id' => $album->id,
                        'user_id' => auth()->user()->id,
                        'title' => $album->title,
                        'slug' => $album->slug,
                        'size' => $photosUpload['size'][$item],
                        'images' => $photosUpload['data'][$item],
                        'images_thumbnail' => $photosUpload['dataThumbnail'][$item],
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
                    'slug' => $album->slug,
                    'size' => $photosUpload['size'],
                    'images' => $photosUpload['data'],
                    'images_thumbnail' => $photosUpload['dataThumbnail'],
                    'description' => Str::limit(strip_tags($album->description), 200),
                    'published' => $published,
                    'published_at' => $published_at,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]);
                Toastr::info('Das Fotos wurden dem Album ' . $album->title . ' erfolgreich hinzugefügt.', 'Erfolgreich!');
            }
        }

        Album::where('id', $request->album_id)->update([
            'path' => $path,
            'thumbnail_id' => Photo::where('album_id', $album->id)->inRandomOrder()->first()->id,
        ]);

        return redirect(route('frontend.galerie.show', $album->slug));
    }

    public function show(Photo $photo)
    {
    }

    public function edit(Photo $photo)
    {
    }

    public function update(Request $request, Photo $photo)
    {
    }

    public function updatePreview(Request $request, Photo $photo)
    {
        Album::where('id', $photo->album_id)->update([
            'thumbnail_id' => $photo->id,
            'updated_at' => now(),
        ]);

        Toastr::info('Vorschaubild wurde geändert!', 'Geändert!');
        return redirect(route('frontend.galerie.show', $photo->slug));
    }

    public function destroy(Request $request, Photo $photo)
    {
        $foto = Photo::where('id', $request->id)->first();
        if (File::exists($foto->images_thumbnail)) {
            File::delete($foto->images_thumbnail);
        }
        if (File::exists($foto->images)) {
            File::delete($foto->images);
        }
        $foto->delete();
        Toastr::error('Bild wurde Gelöscht!', 'Gelöscht!');
        return redirect(route('frontend.galerie.show', $photo->slug));
    }

    public function destroyPhoto(Request $request, Album $galerie)
    {
        dd($request->all());
    }
}
