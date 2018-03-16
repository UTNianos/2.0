<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablasProfesores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->references('id')->on('usuarios');
            $table->timestamps();
        });
        Schema::create('alumnos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->references('id')->on('usuarios');
            $table->integer('plan_id')->references('id')->on('planes');
            $table->timestamps();
        });

        Schema::create('materia_profesor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profesor_id')->references('id')->on('profesores');
            $table->integer('materia_id')->references('id')->on('materias');
        });

        Schema::create('alumno_materia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('alumno_id')->references('id')->on('alumnos');
            $table->integer('materia_id')->references('id')->on('materias');
            $table->tinyInteger('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profesores');
        Schema::dropIfExists('alumnos');
        Schema::dropIfExists('materia_profesor');
        Schema::dropIfExists('alumno_materia');
    }
}
