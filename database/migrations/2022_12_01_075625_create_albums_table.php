<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2022_12_01_075625_create_albums_table.php
 * User: ${USER}
 * Date: 1.${MONTH_NAME_FULL}.2022
 * Time: 7:56
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('fahrzeug_id')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('size')->nullable();
            $table->string('description')->nullable();
            $table->string('kategorie')->nullable();
            $table->unsignedBigInteger('thumbnail_id')->nullable();
            $table->tinyInteger('published')->default(0);
            $table->timestamp('published_at')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('albums');
    }
};
