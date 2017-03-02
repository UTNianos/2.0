<?php

namespace Utnianos\Core;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Utnianos\Core\Usuario
 *
 * @property integer $id
 * @property string $usuario
 * @property string $email
 * @property string $password
 * @property string $avatar
 * @property string $provider
 * @property string $provider_id
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Usuario extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
