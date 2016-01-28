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
 * UtnianosCore\Models\Materia
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\UtnianosCore\Models\Plan[] $planes
 * @property-read \Illuminate\Database\Eloquent\Collection|\UtnianosCore\Models\Correlativa[] $correlativas
 * @property-read \Illuminate\Database\Eloquent\Collection|\UtnianosCore\Models\Correlativa[] $habilita
 */
class Materia extends Model
{
    use SoftDeletes;

    public $timestamps = false;

    public function planes()
    {
        return $this->belongsToMany('UtnianosCore\Models\Plan')->withPivot('año', 'electiva');
    }

    public function correlativas()
    {
        return $this->hasMany('UtnianosCore\Models\Correlativa');
    }

    public function habilita()
    {
        return $this->hasMany('UtnianosCore\Models\Correlativa','requerimiento_id');
    }
}