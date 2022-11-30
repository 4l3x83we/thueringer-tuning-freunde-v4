<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: KontaktsController.php
 * User: ${USER}
 * Date: 30.${MONTH_NAME_FULL}.2022
 * Time: 10:36
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\Kontakt\KontaktMail;
use App\Models\Kontakt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yoeunes\Toastr\Facades\Toastr;

class KontaktsController extends Controller
{
    public function index()
    {
        return view('frontend.kontakt');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'subject' => 'required|min:8',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('frontend.kontakt.index'))->withErrors($validator)->withInput();
        }

        $kontakt = new Kontakt();
        $kontakt->name = $request->name;
        $kontakt->email = $request->email;
        $kontakt->subject = $request->subject;
        $kontakt->message = $request->message;
        $kontakt->read = false;
        $kontakt->save();

        Mail::to(env('TTF_EMAIL'))->send(new KontaktMail($kontakt));
        Toastr::success('Kontaktanfrage wurde erfolgreich versendet', 'Erfolgreich versendet');
        return redirect(route('frontend.kontakt.index'));
    }
}
