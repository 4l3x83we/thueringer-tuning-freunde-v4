<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: KalenderType.php
 * User: ${USER}
 * Date: 12.${MONTH_NAME_FULL}.2022
 * Time: 9:3
 */

namespace App\Models\Intern\Kalender;

use Illuminate\Database\Eloquent\Model;

class KalenderType extends Model
{
    protected $table = 'kalendertype';

    protected $guarded = [];

    public function kalenders()
    {
        return $this->belongsToMany(Kalender::class, 'kalenders_kalendertype');
    }
}
