<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductoRequest;
use Illuminate\Http\Request;
use App\Models\Proveedores_producto;
use App\Models\Detalle_salida;
use App\Models\Detalle_entrada;
use App\Models\Proveedor;
use App\Models\Producto;

class ProductosController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $productos = Producto::paginate(10);
        
        return view('productos', ['productos' => $productos]);
    }

    public function create(CreateProductoRequest $request) {

        $producto = Producto::create([
            'name' => $request['name'],
            'cantidad' => $request['cantidad'],
            'precio' => $request['precio'],
            'descripcion' => $request['descripcion'],
            'iva' => $request['iva'],
        ]);

        if ($producto->save()) {
            $proveedor = Proveedores_producto::create([
                'productos_id' => $producto->id,
                'proveedores_id' => $request['proveedores_id']
            ]);
            $proveedor->save();
            return redirect()->route('productos')->with('create', 1);
        } else {
            return redirect()->route('productos')->with('create', 0);
        }

    }

    public function show(Request $request) {
        $producto = Producto::find($request['id']);
        $proveedores = Proveedor::all();
        $proveedores_producto = Proveedores_producto::where('productos_id', $request['id'])->with('proveedor')->get();

        return [
            'producto' => $producto,
            'proveedores' => $proveedores,
            'proveedores_producto' => $proveedores_producto
        ];
    }

    public function update(Request $request) {

        $producto = Producto::find($request['id']);

        $producto->update([
            'name' => $request['name'],
            'cantidad' => $request['cantidad'],
            'precio' => $request['precio'],
            'descripcion' => $request['descripcion'],
            'proveedores_id' => $request['proveedores_id'],
        ]);

        return redirect()->route('productos')->with('update', 1);
        
    }

    public function deleteProveedor(Request $request) {
        $delete = Proveedores_producto::where('productos_id', $request['id_producto_delete'])->where('proveedores_id', $request['id_proveedor_delete'])->first();

        if ($delete->delete()) {
            return redirect()->route('productos')->with('delete', 1);
        } else {
            return redirect()->route('productos')->with('delete', 0);
        }
    }

    public function addProveedor(Request $request) {
        
        $proveedor = Proveedores_producto::create([
            'productos_id' => $request['id_producto_add'],
            'proveedores_id' => $request['id_proveedores_add']
        ]);
        
        if ($proveedor->save()) {
            return redirect()->route('productos')->with('add', 1);
        } else {
            return redirect()->route('productos')->with('add', 0);
        }
    }

    public function historialSalidas(Request $request) {
        $salidas = Detalle_salida::where('productos_id', $request['id'])->with('productos')->with('salida')->paginate(10);

        // return ['salidas' => $salidas];
        return view('historial_salidas', ['salidas' => $salidas]);
    }
    
    public function historialEntradas(Request $request) {
        $entradas = Detalle_entrada::where('productos_id', $request['id'])->with('productos')->with('entrada')->paginate(10);

        return view('historial_entradas', ['entradas' => $entradas]);
    }
}
