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
 * UtnianosCore\Models\Correlativa
 *
 * @property integer $id
 * @property integer $materia_id
 * @property integer $requerimiento_id
 * @property integer $plan_id
 * @property string $tipo_materia
 * @property string $tipo_requerimiento
 * @property-read \UtnianosCore\Models\Materia $materia
 * @property-read \UtnianosCore\Models\Materia $requerimiento
 * @property-read \UtnianosCore\Models\Plan $plan
 */
class Correlativa extends Model
{
    public $timestamps = false;

    public function materia()
    {
        return $this->belongsTo('UtnianosCore\Models\Materia');
    }

    public function requerimiento()
    {
        return $this->belongsTo('UtnianosCore\Models\Materia','requerimiento_id');
    }

    public function plan()
    {
        return $this->belongsTo('UtnianosCore\Models\Plan');
    }

}