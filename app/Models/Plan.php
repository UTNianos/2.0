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
 * \App\Models\Plan
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $carrera_id
 * @property string $deleted_at
 * @property-read \App\Models\Carrera $carrera
 * @property-read Collection|\App\Models\Materia[] $materias
 * @property-read Collection|\App\Models\Correlativa[] $correlativas
 */
class Plan extends Model
{
    use SoftDeletes;

    protected $table = 'planes';
    public $timestamps = false;

    public function carrera()
    {
        return $this->belongsTo('\App\Models\Carrera');
    }

    public function materias()
    {
        return $this->belongsToMany('\App\Models\Materia')
            ->withPivot('año', 'electiva');
    }

    public function correlativas()
    {
        return $this->hasMany('\App\Models\Correlativa');
    }
}