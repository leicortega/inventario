<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $fillable = [
        'fecha', 'total', 'proveedores_id', 'users_id'
    ];

    public function proveedor() {
        return $this->belongsTo('\App\Models\Proveedor', 'proveedores_id');
    }

    public function vendedor() {
        return $this->belongsTo('\App\User', 'users_id');
    }

    public function detalle_entradas() {
        return $this->hasMany('\App\Models\Detalle_entrada', 'entradas_id');
    }
}
