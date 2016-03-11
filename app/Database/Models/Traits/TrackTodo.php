<?php
namespace Utnianos\Core\Database\Models\Traits;

/**
 * Description of TrackModificacion
 *
 * @author Javier Rotelli
 */
trait TrackTodo
{
    use TrackDelete, TrackModificacion {
        TrackDelete::bootTrackeable insteadof TrackModificacion;
        TrackDelete::asociarUsuarioLogueado insteadof TrackModificacion;
    }
}
