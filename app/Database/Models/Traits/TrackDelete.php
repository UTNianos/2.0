<?php
namespace Utnianos\Core\Database\Models\Traits;

/**
 * Description of Trackeable
 *
 * @author Javier Rotelli
 */
trait TrackDelete
{
    use Trackeable,\Illuminate\Database\Eloquent\SoftDeletes;
    
    public function borradoPor()
    {
        return $this->belongsTo('Utnianos\Core\Usuario','borrado_por');
    }
    
    public static function bootTrackDelete()
    {
        $handler = function(\Eloquent $model){
                $asoc = self::asociarUsuarioLogueado('borradoPor');
                $asoc($model);
                $model->save();
            };
        static::deleting($handler);
    }
}
