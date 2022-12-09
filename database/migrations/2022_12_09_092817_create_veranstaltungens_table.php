<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2022_12_09_092817_create_veranstaltungens_table.php
 * User: ${USER}
 * Date: 9.${MONTH_NAME_FULL}.2022
 * Time: 9:28
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('veranstaltungens', function (Blueprint $table) {
            $table->id();



            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('veranstaltungens');
    }
};
