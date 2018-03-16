<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    public function usuario()
    {
        return $this->belongsTo('\App\Usuario');
    }

    public function materias()
    {
        return $this->belongsToMany('\App\Models\Materia')->withPivot(['estado']);
    }
}
