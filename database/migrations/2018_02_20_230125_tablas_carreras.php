<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablasCarreras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facultades',function(Blueprint $table){
            $table->increments('id');
            $table->string('nombre');
            $table->string('abreviatura');
        });

        Schema::create('carreras',function(Blueprint $table){
            $table->increments('id');
            $table->string('nombre');
            $table->string('abreviatura');
        });

        Schema::create('carrera_facultad',function(Blueprint $table){
            $table->increments('id');

            $table->integer('facultad_id')->unsigned();
            $table->foreign('facultad_id')->references('id')->on('facultades');

            $table->integer('carrera_id')->unsigned();
            $table->foreign('carrera_id')->references('id')->on('carreras');
        });

        Schema::create('planes',function(Blueprint $table){
            $table->increments('id');
            $table->string('nombre');

            $table->integer('carrera_id')->unsigned();
            $table->foreign('carrera_id')->references('id')->on('carreras');

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
        Schema::drop('planes');
        Schema::drop('carrera_facultad');
        Schema::drop('carreras');
        Schema::drop('facultades');
    }
}
