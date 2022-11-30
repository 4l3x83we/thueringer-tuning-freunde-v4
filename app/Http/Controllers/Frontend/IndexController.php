<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: IndexController.php
 * User: ${USER}
 * Date: 29.${MONTH_NAME_FULL}.2022
 * Time: 15:49
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function impressum()
    {
        return view('frontend.impressum');
    }

    public function datenschutz()
    {
        return view('frontend.datenschutz');
    }
}
