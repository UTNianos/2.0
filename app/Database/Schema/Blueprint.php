<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Utnianos\Core\Database\Schema;

/**
 * Description of Blueprint
 *
 * @author Javier Rotelli
 */
class Blueprint extends \Illuminate\Database\Schema\Blueprint
{

    public function trackingTimestamps()
    {
        $this->timestamps();
        $this->integer('creado_por')->unsigned();
        $this->foreign('creado_por')->references('id')->on('usuarios');
        $this->integer('modificado_por')->unsigned()->nullable();
        $this->foreign('modificado_por')->references('id')->on('usuarios');
    }

    public function dropTrackingTimestamps()
    {
        $this->dropForeign($this->table.'_creado_por_foreign');
        $this->removeColumn('creado_por');
        $this->dropForeign($this->table.'_modificado_por_foreign');
        $this->removeColumn('modificado_por');

        $this->dropTimestamps();
    }

    public function trackingSoftDeletes()
    {
        $this->softDeletes();
        $this->integer('borrado_por')->unsigned()->nullable();

        $this->foreign('borrado_por')->references('id')->on('usuarios');
    }

    public function dropTrackingSoftDeletes()
    {
        $this->dropSoftDeletes();
        $this->dropForeign($this->table.'_borrado_por_foreign');
        $this->removeColumn('borrado_por');
    }
}