<?php

namespace Utnianos\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    public function usuario()
    {
        return $this->belongsTo('Utnianos\Core\Usuario');
    }

    public function materias()
    {
        return $this->belongsToMany('Utnianos\Core\Models\Materia')->withPivot(['estado']);
    }
}
