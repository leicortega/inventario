<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detalle_entrada extends Model
{
    protected $fillable = [
        'cantidad', 'precio', 'productos_id', 'entradas_id'
    ];

    public function productos() {
        return $this->belongsTo('App\Models\Producto', 'productos_id');
    }

    public function entrada() {
        return $this->belongsTo('App\Models\Entrada', 'entradas_id');
    }
}
