<?php
/**
 * Created by PhpStorm.
 * Date: 28/01/16
 * Time: 19:19
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * \App\Models\Correlativa
 *
 * @property integer $id
 * @property integer $materia_id
 * @property integer $requerimiento_id
 * @property integer $plan_id
 * @property string $tipo_materia
 * @property integer $tipo_requerimiento
 * @property-read \App\Models\Materia $materia
 * @property-read \App\Models\Materia $requerimiento
 * @property-read \App\Models\Plan $plan
 */
class Correlativa extends Model
{
    const CURSADA_CURSADA = 0;
    const CURSADA_FINAL = 1;
    const FINAL_FINAL = 2;
    const FINAL_CURSADA = 3;

    public $timestamps = false;


    public function materia()
    {
        return $this->belongsTo('\App\Models\Materia');
    }

    public function requerimiento()
    {
        return $this->belongsTo('\App\Models\Materia',
                                'requerimiento_id');
    }

    public function plan()
    {
        return $this->belongsTo('\App\Models\Plan');
    }
}