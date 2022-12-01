<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2022_12_01_075704_create_photos_table.php
 * User: ${USER}
 * Date: 1.${MONTH_NAME_FULL}.2022
 * Time: 7:57
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('album_id')->nullable();
            $table->unsignedBigInteger('fahrzeug_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->string('size')->nullable();
            $table->string('images')->nullable();
            $table->string('images_thumbnail')->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('thumbnail')->default(0);
            $table->tinyInteger('published')->default(0);
            $table->timestamp('published_at')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
            $table->foreign('fahrzeug_id')->references('id')->on('fahrzeuges')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('photos');
    }
};
