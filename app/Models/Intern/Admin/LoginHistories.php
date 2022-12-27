<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: LoginHistories.php
 * User: ${USER}
 * Date: 27.${MONTH_NAME_FULL}.2022
 * Time: 8:2
 */

namespace App\Models\Intern\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class LoginHistories extends Model
{
    protected $table = 'login_histories';

    protected $fillable = [
        'ip_address',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
