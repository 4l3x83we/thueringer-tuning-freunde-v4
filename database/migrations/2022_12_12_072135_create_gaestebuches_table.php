<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2022_12_12_072135_create_gaestebuches_table.php
 * User: ${USER}
 * Date: 12.${MONTH_NAME_FULL}.2022
 * Time: 7:21
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('gaestebuches', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email');
            $table->text('message');
            $table->string('facebook')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('instagram')->nullable();
            $table->string('website')->nullable();
            $table->tinyInteger('published')->default(0);
            $table->timestamp('published_at')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gaestebuches');
    }
};
