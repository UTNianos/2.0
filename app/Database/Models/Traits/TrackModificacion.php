<?php
namespace Utnianos\Core\Database\Models\Traits;

/**
 * Description of TrackModificacion
 *
 * @author Javier Rotelli
 */
trait TrackModificacion
{
    use Trackeable;
    
    public function creador()
    {
        return $this->belongsTo('Utnianos\Core\Usuarios\User','creado_por');
    }
    
    public function editadoPor()
    {
        return $this->belongsTo('Utnianos\Core\Usuarios\User','modificado_por');
    }
    
    public static function bootTrackModificacion()
    {
        static::creating(self::asociarUsuarioLogueado('creador'));
        static::updating(self::asociarUsuarioLogueado('editadoPor'));
        static::saving(self::asociarUsuarioLogueado('editadoPor'));
    }
}
