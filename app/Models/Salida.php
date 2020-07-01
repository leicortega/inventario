<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    protected $fillable = [
        'fecha', 'total', 'clientes_id', 'users_id'
    ];

    public function cliente() {
        return $this->belongsTo('\App\Models\Cliente', 'clientes_id');
    }

    public function vendedor() {
        return $this->belongsTo('\App\User', 'users_id');
    }

    public function detalle_salidas() {
        return $this->hasMany('\App\Models\Detalle_salida', 'salidas_id');
    }

    public function productos() {
        return $this->hasManyThrough(
            'App\Models\Producto', // Modelo destino
            'App\Models\Detalle_salida', // Modelo intermedio
            'productos_id', // Clave foránea en la tabla intermedia
            'id', // Clave foránea en la tabla de destino
            'id', // Clave primaria en la tabla de origen
            'id', // Clave primaria en la tabla intermedia
        );
    }
}
