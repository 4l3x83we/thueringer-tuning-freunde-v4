<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2022_12_12_090045_create_kalendertype_table.php
 * User: ${USER}
 * Date: 12.${MONTH_NAME_FULL}.2022
 * Time: 9:0
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kalendertype', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('cp_user_id')->nullable();
            $table->string('type');
            $table->string('typeColor');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kalendertype');
    }
};
