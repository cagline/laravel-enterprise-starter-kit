<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('city_id')->signed();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('address');
            $table->string('house_size');
            $table->string('land_size');
            $table->string('map');
            $table->string('type');
            $table->boolean('sold');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lands');
    }

}
