<?php

namespace Utnianos\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $table = 'profesores';

    public function usuario()
    {
        return $this->hasOne('Utnianos\Core\Usuario');
    }

    public function materias()
    {
        return $this->belongsToMany('Utnianos\Core\Models\Materia');
    }
}
