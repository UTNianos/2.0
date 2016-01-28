<?php
/**
 * Created by PhpStorm.
 * Date: 28/01/16
 * Time: 19:07
 */

namespace UtnianosCore\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * UtnianosCore\Models\Facultad
 *
 * @property integer $id
 * @property string $nombre
 * @property-read \Illuminate\Database\Eloquent\Collection|\UtnianosCore\Models\Carrera[] $carreras
 */
class Facultad extends Model
{
    protected $table = 'facultades';
    public $timestamps = false;

    public function carreras()
    {
        return $this->belongsToMany('UtnianosCore\Models\Carrera');
    }

}