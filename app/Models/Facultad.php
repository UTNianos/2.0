<?php
/**
 * Created by PhpStorm.
 * Date: 28/01/16
 * Time: 19:07
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * \App\Models\Facultad
 *
 * @property integer $id
 * @property string $nombre
 * @property string $abreviatura
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Carrera[] $carreras
 */
class Facultad extends Model
{
    protected $table = 'facultades';
    public $timestamps = false;

    public function carreras()
    {
        return $this->belongsToMany('\App\Models\Carrera');
    }
}