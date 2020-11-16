<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProveedoresRequest;
use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedoresController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $proveedores = Proveedor::paginate(10);

        return view('proveedores', ['proveedores' => $proveedores]);
    }

    public function create(CreateProveedoresRequest $request) {

        $proveedor = Proveedor::create([
            'nit' => $request['nit'],
            'name' => $request['name'],
            'telefono' => $request['telefono'],
            'direccion' => $request['direccion'],
            'regimen' => $request['regimen'],
        ]);

        if ($proveedor->save()) {
            return redirect()->route('proveedores')->with('create', 1);
        } else {
            return redirect()->route('proveedores')->with('create', 0);
        }

    }

    public function show(Request $request) {
        $proveedor = Proveedor::find($request['id']);

        return [
            'proveedor' => $proveedor,
        ];
    }

    public function update(Request $request) {

        $proveedor = Proveedor::find($request['id']);

        $proveedor->update([
            'nit' => $request['nit'],
            'name' => $request['name'],
            'telefono' => $request['telefono'],
            'direccion' => $request['direccion'],
            'regimen' => $request['regimen'],
        ]);

        return redirect()->route('proveedores')->with('update', 1);

    }

    public function buscar(Request $request) {
        $proveedores = Proveedor::where('nit', 'LIKE', '%'.$request['buscar'].'%')->orWhere('name', 'LIKE', '%'.$request['buscar'].'%')->orWhere('telefono', 'LIKE', '%'.$request['buscar'].'%')->paginate(10);

        return view('proveedores', ['proveedores' => $proveedores]);
    }
}
