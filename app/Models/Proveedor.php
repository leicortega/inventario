<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';

    protected $fillable = [
        'nit', 'name', 'telefono', 'direccion', 'regimen'
    ];

    public function productos() {
        return $this->hasMany('App\Producto');
    }
}
