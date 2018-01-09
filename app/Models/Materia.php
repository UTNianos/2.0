<?php
/**
 * Created by PhpStorm.
 * Date: 28/01/16
 * Time: 19:19
 */

namespace Utnianos\Core\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Utnianos\Core\Models\Materia
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $deleted_at
 * @property-read Collection|\Utnianos\Core\Models\Plan[] $planes
 * @property-read Collection|\Utnianos\Core\Models\Correlativa[] $correlativas
 * @property-read Collection|\Utnianos\Core\Models\Correlativa[] $habilita
 * @property string $abreviatura
 * @property boolean $basica
 */
class Materia extends Model
{
    use SoftDeletes;

    public $timestamps = false;

    public function planes()
    {
        return $this->belongsToMany('Utnianos\Core\Models\Plan')
            ->withPivot('año', 'electiva');
    }

    public function correlativas()
    {
        return $this->hasMany('Utnianos\Core\Models\Correlativa');
    }

    public function habilita()
    {
        return $this->hasMany('Utnianos\Core\Models\Correlativa',
                              'requerimiento_id');
    }

    public function profesores()
    {
        return $this->belongsToMany('Utnianos\Core\Models\Profesor');
    }

    public function alumnos()
    {
        return $this->belongsToMany('Utnianos\Core\Models\Alumno')->withPivot(['estado']);
    }
}