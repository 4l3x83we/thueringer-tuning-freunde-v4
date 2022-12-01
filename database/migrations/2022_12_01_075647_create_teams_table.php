<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2022_12_01_075747_create_teams_table.php
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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users');
            $table->unsignedBigInteger('fahrzeug_id')->nullable();
            $table->unsignedBigInteger('antrag_id')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('anrede');
            $table->string('vorname');
            $table->string('nachname');
            $table->string('straße');
            $table->string('plz');
            $table->string('wohnort');
            $table->string('telefon')->nullable();
            $table->string('mobil');
            $table->string('email');
            $table->string('geburtsdatum');
            $table->string('beruf');
            $table->string('description')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('funktion')->nullable();
            $table->string('emailIntern')->nullable();
            $table->string('ip_adresse', 45)->nullable();
            $table->tinyInteger('fahrzeug_vorhanden')->default(0);
            $table->tinyInteger('published')->default(0);
            $table->timestamp('published_at')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teams');
    }
};
