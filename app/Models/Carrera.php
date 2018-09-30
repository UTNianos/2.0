<?php
/**
 * Created by PhpStorm.
 * Date: 28/01/16
 * Time: 19:09
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * \App\Models\Carrera
 *
 * @property integer $id
 * @property string $nombre
 * @property-read Collection|\App\Models\Carrera[] $facultades
 * @property-read Collection|\App\Models\Plan[] $planes
 * @property string $abreviatura
 */
class Carrera extends Model
{
    public $timestamps = false;

    public function facultades()
    {
        return $this->belongsToMany('\App\Models\Facultad');
    }

    public function planes()
    {
        return $this->hasMany('\App\Models\Plan');
    }
}