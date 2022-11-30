<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2022_11_30_104249_create_kontakts_table.php
 * User: ${USER}
 * Date: 30.${MONTH_NAME_FULL}.2022
 * Time: 10:42
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kontakts', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('subject')->nullable();
            $table->longText('message')->nullable();
            $table->tinyInteger('read')->default(false);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kontakts');
    }
};
