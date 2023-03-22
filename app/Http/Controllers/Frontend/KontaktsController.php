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
use App\Mail\Kontakt\SpamMail;
use App\Models\Kontakt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Yoeunes\Toastr\Facades\Toastr;

class KontaktsController extends Controller
{
    public function index()
    {
        $xml = simplexml_load_string(file_get_contents("https://www.stopforumspam.com/api?ip=" . urlencode($_SERVER['REMOTE_ADDR'])));

        return view('frontend.kontakt', compact('xml'));
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

        $spamMail = simplexml_load_string(file_get_contents("https://www.stopforumspam.com/api?email=" . $request->email."&ip=" . urlencode($_SERVER['REMOTE_ADDR'])));

        $kontakt = new Kontakt();
        $kontakt->name = $request->name;
        $kontakt->email = $request->email;
        $kontakt->subject = $request->subject;
        $kontakt->message = $request->message;
        $kontakt->read = false;
        $kontakt->ip_adresse = $request->getClientIp();
        if ($spamMail->appears == "no" and $spamMail->appears == "no") {
            $kontakt->save();

            Mail::to(env('TTF_EMAIL'))->send(new KontaktMail($kontakt));
            Toastr::success('Kontaktanfrage wurde erfolgreich versendet', 'Erfolgreich versendet');
            return redirect(route('frontend.kontakt.index'));
        } else {
            $spamString = '?username='. htmlentities(urlencode($request->name), ENT_COMPAT, 'UTF-8') . '&ip_addr=' . urlencode($request->getClientIp()) . '&evidence=' . htmlentities(urlencode($request->message), ENT_COMPAT, 'UTF-8') . '&email=' . urlencode($request->email) .'&api_key=r65dkc4ipgt17m';
            Http::get('https://www.stopforumspam.com/add.php'.$spamString);
            Mail::to($request->email)->send(new SpamMail($kontakt));
            Toastr::error("Your spam didn't go through have fun keeping spamming.", 'Spam Mail');
            return redirect(route('frontend.index'));
        }
    }
}
