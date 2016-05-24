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
 * Utnianos\Core\Models\Plan
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $carrera_id
 * @property string $deleted_at
 * @property-read \Utnianos\Core\Models\Carrera $carrera
 * @property-read Collection|\Utnianos\Core\Models\Materia[] $materias
 * @property-read Collection|\Utnianos\Core\Models\Correlativa[] $correlativas
 */
class Plan extends Model
{
    use SoftDeletes;

    protected $table = 'planes';
    public $timestamps = false;

    public function carrera()
    {
        return $this->belongsTo('Utnianos\Core\Models\Carrera');
    }

    public function materias()
    {
        return $this->belongsToMany('Utnianos\Core\Models\Materia')
            ->withPivot('año', 'electiva');
    }

    public function correlativas()
    {
        return $this->hasMany('Utnianos\Core\Models\Correlativa');
    }
}