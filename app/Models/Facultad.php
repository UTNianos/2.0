<?php
/**
 * Created by PhpStorm.
 * Date: 28/01/16
 * Time: 19:07
 */

namespace Utnianos\Core\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Utnianos\Core\Models\Facultad
 *
 * @property integer $id
 * @property string $nombre
 * @property-read \Illuminate\Database\Eloquent\Collection|\Utnianos\Core\Models\Carrera[] $carreras
 */
class Facultad extends Model
{
    protected $table = 'facultades';
    public $timestamps = false;

    public function carreras()
    {
        return $this->belongsToMany('Utnianos\Core\Models\Carrera');
    }

}