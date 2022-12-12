<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: GaestebuchesController.php
 * User: ${USER}
 * Date: 12.${MONTH_NAME_FULL}.2022
 * Time: 7:21
 */

namespace App\Http\Controllers\Frontend\Gaestebuch;

use App\Http\Controllers\Controller;
use App\Mail\Gaestebuch\GaestebuchEintragMail;
use App\Models\Frontend\Gaestebuch\Gaestebuch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yoeunes\Toastr\Facades\Toastr;

class GaestebuchesController extends Controller
{
    public function index()
    {
        $gaestebuchs = Gaestebuch::orderBy('created_at', 'DESC')->get();

        return view('frontend.gaestebuch', compact('gaestebuchs'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4|max:50',
            'email' => 'required|email',
            'message' => 'required'
        ], [
            'message.required' => 'Nachricht muss ausgefüllt werden.',
            'email.required' => 'E-Mail Adresse muss ausgefüllt werden.',
        ]);

        if ($validator->fails()) {
            return redirect(route('frontend.gaestebuch.index'))->withErrors($validator)->withInput();
        }

        $gaestebuch = new Gaestebuch();
        $gaestebuch->name = $request->name;
        $gaestebuch->email = $request->email;
        $gaestebuch->website = $request->website;
        $gaestebuch->facebook = $request->facebook;
        $gaestebuch->tiktok = $request->tiktok;
        $gaestebuch->instagram = $request->instagram;
        $gaestebuch->message = $request->message;
        $gaestebuch->published = 0;
        $gaestebuch->save();

        Mail::to('info@thueringer-tuning-freunde.de')->send(new GaestebuchEintragMail($gaestebuch));
        Toastr::success('Gästebucheintrag wurde erfolgreich eingesandt.', 'Eingesandt');
        return redirect()->route('frontend.gaestebuch.index');
    }

    public function update(Request $request, Gaestebuch $gaestebuch)
    {
        $gaestebuch->published = $request->published;
        $gaestebuch->published_at = now();
        $gaestebuch->save();

        Toastr::success('Gästebucheintrag freigegeben.', 'Freigegeben');
        return redirect()->route('frontend.gaestebuch.index');
    }

    public function destroy(Gaestebuch $gaestebuch)
    {
        $gaestebuch->delete();
        Toastr::error('Gästebucheintrag wurde gelöscht!', 'Gelöscht');
        return redirect()->route('frontend.gaestebuch.index');
    }
}
