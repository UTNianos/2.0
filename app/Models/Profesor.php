<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $table = 'profesores';

    public function usuario()
    {
        return $this->hasOne('\App\Usuario');
    }

    public function materias()
    {
        return $this->belongsToMany('\App\Models\Materia');
    }
}
