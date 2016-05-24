<?php
/**
 * Created by PhpStorm.
 * Date: 28/01/16
 * Time: 19:19
 */

namespace Utnianos\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Utnianos\Core\Models\Correlativa
 *
 * @property integer $id
 * @property integer $materia_id
 * @property integer $requerimiento_id
 * @property integer $plan_id
 * @property string $tipo_materia
 * @property integer $tipo_requerimiento
 * @property-read \Utnianos\Core\Models\Materia $materia
 * @property-read \Utnianos\Core\Models\Materia $requerimiento
 * @property-read \Utnianos\Core\Models\Plan $plan
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
        return $this->belongsTo('Utnianos\Core\Models\Materia');
    }

    public function requerimiento()
    {
        return $this->belongsTo('Utnianos\Core\Models\Materia',
                                'requerimiento_id');
    }

    public function plan()
    {
        return $this->belongsTo('Utnianos\Core\Models\Plan');
    }
}