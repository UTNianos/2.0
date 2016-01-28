<?php
/**
 * Created by PhpStorm.
 * Date: 28/01/16
 * Time: 19:09
 */

namespace UtnianosCore\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * UtnianosCore\Models\Carrera
 *
 * @property integer $id
 * @property string $nombre
 * @property-read \Illuminate\Database\Eloquent\Collection|\UtnianosCore\Models\Carrera[] $facultades
 * @property-read \Illuminate\Database\Eloquent\Collection|\UtnianosCore\Models\Plan[] $planes
 */
class Carrera extends Model
{
    public $timestamps = false;

    public function facultades()
    {
        return $this->belongsToMany('UtnianosCore\Models\Carrera');
    }

    public function planes()
    {
        return $this->hasMany('UtnianosCore\Models\Plan');
    }
}