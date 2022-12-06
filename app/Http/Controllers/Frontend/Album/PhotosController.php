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

use App\Http\Controllers\Controller;
use App\Models\Frontend\Album\Album;
use App\Models\Frontend\Album\Photo;
use Illuminate\Http\Request;
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

    public function destroy(Photo $photo)
    {
    }
}
