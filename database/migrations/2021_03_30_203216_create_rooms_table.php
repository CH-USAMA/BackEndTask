<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('superHost')->nullable();
            $table->string('residentType')->nullable();
            $table->string('location')->nullable();
            $table->string('samplePhotoUrl')->nullable();
            $table->string('guests')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('beds')->nullable();
            $table->string('baths')->nullable();
            $table->string('rating')->nullable();
            $table->integer('personReviewed')->nullable();
            $table->string('costs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
