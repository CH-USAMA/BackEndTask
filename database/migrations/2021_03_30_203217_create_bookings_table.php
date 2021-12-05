<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->nullable();
            $table->integer('rooms_id');
            // $table->foreign('rooms_id')->references('id')->on('rooms'); 
            $table->string('time')->nullable();
            $table->string('no_of_days')->nullable();
            $table->timestamps();
        });

        // Schema::table('bookings', function (Blueprint $table) {
        //     $table->foreign('rooms_id')->references('id')->on('rooms');    
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
