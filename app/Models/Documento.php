<?php
/**
 * Created by PhpStorm.
 * Date: 12/03/16
 * Time: 17:54
 */

namespace Utnianos\Core\Models;

use Utnianos\Core\Database\Models\Traits\TrackTodo;

/**
 * Utnianos\Core\Models\Documento
 *
 * @property integer $id
 * @property integer $duenio_id
 * @property string $duenio_type
 * @property integer $version
 * @property string $nombre
 * @property string $contenido
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $creado_por
 * @property integer $modificado_por
 * @property string $deleted_at
 * @property integer $borrado_por
 * @property-read \Utnianos\Core\Usuario $borradoPor
 * @property-read \Utnianos\Core\Usuario $creador
 * @property-read \Utnianos\Core\Usuario $editadoPor
 * @property-read \Utnianos\Core\Models\Documento $duenio
 */
class Documento extends \Eloquent
{
    use TrackTodo;

    public function duenio()
    {
        return $this->morphTo();
    }
}