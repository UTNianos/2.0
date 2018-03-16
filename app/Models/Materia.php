<?php
/**
 * Created by PhpStorm.
 * Date: 28/01/16
 * Time: 19:19
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * \App\Models\Materia
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $deleted_at
 * @property-read Collection|\App\Models\Plan[] $planes
 * @property-read Collection|\App\Models\Correlativa[] $correlativas
 * @property-read Collection|\App\Models\Correlativa[] $habilita
 * @property string $abreviatura
 * @property boolean $basica
 */
class Materia extends Model
{
    use SoftDeletes;

    public $timestamps = false;

    public function planes()
    {
        return $this->belongsToMany('App\Models\Plan')
            ->withPivot('año', 'electiva');
    }

    public function correlativas()
    {
        return $this->hasMany('\App\Models\Correlativa');
    }

    public function habilita()
    {
        return $this->hasMany('\App\Models\Correlativa',
                              'requerimiento_id');
    }

    public function profesores()
    {
        return $this->belongsToMany('\App\Models\Profesor');
    }

    public function alumnos()
    {
        return $this->belongsToMany('\App\Models\Alumno')->withPivot(['estado']);
    }
}