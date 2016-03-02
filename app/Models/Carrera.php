<?php
/**
 * Created by PhpStorm.
 * Date: 28/01/16
 * Time: 19:09
 */

namespace Utnianos\Core\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Utnianos\Core\Models\Carrera
 *
 * @property integer $id
 * @property string $nombre
 * @property-read \Illuminate\Database\Eloquent\Collection|\Utnianos\Core\Models\Carrera[] $facultades
 * @property-read \Illuminate\Database\Eloquent\Collection|\Utnianos\Core\Models\Plan[] $planes
 * @property string $abreviatura
 */
class Carrera extends Model
{
    public $timestamps = false;

    public function facultades()
    {
        return $this->belongsToMany('Utnianos\Core\Models\Facultad');
    }

    public function planes()
    {
        return $this->hasMany('Utnianos\Core\Models\Plan');
    }
}