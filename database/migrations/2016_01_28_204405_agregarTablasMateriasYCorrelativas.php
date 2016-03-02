<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarTablasMateriasYCorrelativas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('materias',function(Blueprint $table){
            $table->increments('id');
            $table->string('nombre');
            $table->string('abreviatura')->nullable();
            $table->boolean('basica');

            $table->text('descripcion');

            $table->softDeletes();
        });

        Schema::create('materia_plan',function(Blueprint $table){
            $table->increments('id');

            $table->integer('plan_id')->unsigned();
            $table->foreign('plan_id')->references('id')->on('planes');

            $table->integer('materia_id')->unsigned();
            $table->foreign('materia_id')->references('id')->on('materias');

            $table->tinyInteger('año')->nullable();
            $table->boolean('electiva')->nullable();
        });

        Schema::create('correlativas',function(Blueprint $table){
            $table->increments('id');

            $table->integer('materia_id')->unsigned();
            $table->foreign('materia_id')->references('id')->on('materias');

            $table->integer('requerimiento_id')->unsigned();
            $table->foreign('requerimiento_id')->references('id')->on('materias');

            $table->integer('plan_id')->unsigned();
            $table->foreign('plan_id')->references('id')->on('planes');

            $table->integer('tipo_requerimiento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('correlativas');
        Schema::drop('materia_plan');
        Schema::drop('materias');
    }
}


