<?php


use Utnianos\Core\Database\Migration;
use Utnianos\Core\Database\Schema\Blueprint;

class CrearTablaDocumentos extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('documentos',function(Blueprint $table){
            $table->increments('id');

            $table->integer('duenio_id');
            $table->string('duenio_type');
            $table->integer('version');
            $table->unique(['duenio_id', 'duenio_type', 'version']);

            $table->string('nombre');
            $table->longText('contenido');

            $table->trackingTimestamps();
            $table->trackingSoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->drop('documentos');
    }
}
