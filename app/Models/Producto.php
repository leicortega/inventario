<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'code', 'name', 'cantidad', 'precio', 'descripcion', 'iva'
    ];

    public function proveedores() {
        return $this->hasMany('\App\Models\Proveedores_producto', 'productos_id');
    }
}
