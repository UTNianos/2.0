<?php
namespace Utnianos\Core\Database\Models\Traits;

use Auth;
use Closure;

/**
 * Description of Trackeable
 *
 * @author Javier Rotelli
 */
trait Trackeable
{    
    public static function bootTrackeable()
    {
        static::setEventDispatcher(\App()['events']);
    }
    
    /**
     * genera una funcion que toma como parametro un trackeable y al ejecutarse le asocia a ese objeto
     * el usuario actualmente logueado en $relacion
     * @param string $relacion
     * @return Closure
     */
    public static function asociarUsuarioLogueado($relacion)
    {
        return function($trackeable) use ($relacion){
            $trackeable->{$relacion}()->associate(Auth::user());
        };
    }
    
    
    public abstract function belongsTo($related, $foreignKey = NULL, $otherKey = NULL, $relation = NULL);
}
