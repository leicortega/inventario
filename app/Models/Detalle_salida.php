<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detalle_salida extends Model
{
    protected $fillable = [
        'cantidad', 'precio', 'productos_id', 'salidas_id'
    ];

    public function productos() {
        return $this->belongsTo('App\Models\Producto', 'productos_id');
    }

    public function salida() {
        return $this->belongsTo('\App\Models\Salida', 'salidas_id');
    }
}
