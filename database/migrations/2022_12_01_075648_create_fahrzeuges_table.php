<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2022_12_01_075823_create_fahrzeugs_table.php
 * User: ${USER}
 * Date: 1.${MONTH_NAME_FULL}.2022
 * Time: 7:58
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('fahrzeuges', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('album_id')->nullable();
            $table->unsignedBigInteger('team_id')->nullable();
            $table->string('title');
            $table->string('slug')->unique()->nullable();
            $table->string('baujahr', 10);
            $table->text('besonderheiten')->nullable();
            $table->text('motor');
            $table->text('karosserie')->nullable();
            $table->text('felgen')->nullable();
            $table->text('fahrwerk')->nullable();
            $table->text('bremsen')->nullable();
            $table->text('innenraum')->nullable();
            $table->text('anlage')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('published')->default(0)->nullable();
            $table->timestamp('published_at')->nullable();

            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fahrzeuges');
    }
};
