<?php
/**
 * Created by PhpStorm.
 * Date: 28/01/16
 * Time: 19:19
 */

namespace UtnianosCore\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * UtnianosCore\Models\Plan
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $carrera_id
 * @property string $deleted_at
 * @property-read \UtnianosCore\Models\Carrera $carrera
 * @property-read \Illuminate\Database\Eloquent\Collection|\UtnianosCore\Models\Materia[] $materias
 * @property-read \Illuminate\Database\Eloquent\Collection|\UtnianosCore\Models\Correlativa[] $correlativas
 */
class Plan extends Model
{
    use SoftDeletes;

    protected $table = 'planes';
    public $timestamps = false;

    public function carrera()
    {
        return $this->belongsTo('UtnianosCore\Models\Carrera');
    }

    public function materias()
    {
        return $this->belongsToMany('UtnianosCore\Models\Materia')->withPivot('año', 'electiva');
    }

    public function correlativas()
    {
        return $this->hasMany('UtnianosCore\Models\Correlativa');
    }
}