<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: MyWelcomeController.php
 * User: ${USER}
 * Date: 3.${MONTH_NAME_FULL}.2022
 * Time: 6:24
 */

namespace App\Http\Controllers\Auth;

use Spatie\WelcomeNotification\WelcomeController as BaseWelcomeController;
use Symfony\Component\HttpFoundation\Response;

class MyWelcomeController extends BaseWelcomeController
{
    public function sendPasswordSavedResponse() : Response
    {
        return redirect(route('frontend.index'));
    }

    public function rules()
    {
        return [
            'password' => 'required|confirmed|min:8',
        ];
    }
}
