<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UsuarioFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

#[Fillable([
    'nombre',
    'apellido',
    'email',
    'password',
    'telefono',
    'direccion',
    'ciudad',
    'codigo_postal',
    'pais',
])]
#[Hidden(['password', 'remember_token'])]
class Usuario extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<UsuarioFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'isadmin' => 'boolean',
        ];
    }

    public function carrito()
    {
        return $this->hasOne(Carrito::class)->where('estado', 'activo');
    }

    public function carritoItems()
    {
        return $this->hasManyThrough(Carritoitem::class, Carrito::class, 'usuario_id', 'carrito_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
