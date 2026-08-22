<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $fillable = ['usuario_id', 'estado'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function items()
    {
        return $this->hasMany(Carritoitem::class);
    }
}
