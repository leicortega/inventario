<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedores_producto extends Model
{
    protected $table = 'proveedores_producto';

    protected $fillable = [
        'id', 'productos_id', 'proveedores_id'
    ];

    public function productos() {
        return $this->belongsTo('\App\Models\Producto', 'productos_id');
    }

    public function proveedor() {
        return $this->belongsTo('\App\Models\Proveedor', 'proveedores_id');
    }
}
