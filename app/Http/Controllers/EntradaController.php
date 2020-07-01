<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\User;
use App\Models\Entrada;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Detalle_entrada;
use App\Models\Proveedores_producto;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function index() {
        $entradas = Entrada::orderBy('fecha', 'desc')->paginate(10);

        return view('entradas', ['entradas' => $entradas]);
    }

    public function listProductos(Request $request) {
        return Proveedores_producto::where('proveedores_id', $request['id'])->with('productos')->get();
    }

    public function create(Request $request) {
        $date = Carbon::now('America/Bogota');
        $errors = 0;

        if ($request['total_productos'] == 1) {
            $productos_cantidad = 1;
        } else {
            $productos_cantidad = $request['total_productos'] - 1;
        }

        $entradas = Entrada::create([
            'fecha' => $date->toDateTimeString(),
            'total' => $request['total_entrada_input'],
            'proveedores_id' => $request['proveedor_id'],
            'users_id' => auth()->user()->id,
        ]);

        if ($entradas->save()) {
            for ($i=1; $i <= $productos_cantidad; $i++) { 
                $producto = Producto::find($request['id_producto_'.$i]);

                $detalle_entradas = Detalle_entrada::create([
                    'cantidad' => $request['cantidad_producto_'.$i],
                    'precio' => $request['precio_producto_'.$i],
                    'productos_id' => $producto->id,
                    'entradas_id' => $entradas->id,
                ]);

                if(!$detalle_entradas->save()){
                    $errors = $errors++;
                }

                $stock = ($producto->cantidad + $request['cantidad_producto_'.$i]);

                $producto->update([
                    'cantidad' => $stock
                ]);
            }
        }

        if ($errors == 0) {
            return redirect()->route('entradas')->with('create', 1)->with('entrada', $entradas->id);
        } else {
            return redirect()->route('entradas')->with('create', 0);
        }
    }

    public function showEntrada(Request $request) {
        $entrada = Entrada::with('detalle_entradas')->where('id', $request['id'])->get();

        foreach ($entrada as $key) {
            foreach ($key->detalle_entradas as $row) {
                $id_producto = $row->productos_id;
                $row['nombre_producto'] = Producto::find($id_producto)->name;
            }
        }

        $data = [
            'id_factura' => $entrada[0]->id,
            'fecha' => $entrada[0]->fecha,
            'proveedor' => Proveedor::find($entrada[0]->proveedores_id),
            'usuario' => auth()->user()->name,
            'productos' => $entrada[0]->detalle_entradas,
            'total' => $entrada[0]->total
        ];

        return $data;
    }

    public function printEntrada(Request $request) {
        $entrada = Entrada::with('detalle_entradas')->where('id', $request['id'])->get();

        foreach ($entrada as $key) {
            foreach ($key->detalle_entradas as $row) {
                $id_producto = $row->productos_id;
                $row['nombre_producto'] = Producto::find($id_producto)->name;
            }
        }

        $data = [
            'id_factura' => $entrada[0]->id,
            'fecha' => $entrada[0]->fecha,
            'usuario' => User::find($entrada[0]->users_id),
            'vendedor' => auth()->user()->name,
            'productos' => $entrada[0]->detalle_entradas,
            'total' => $entrada[0]->total
        ];

        $pdf = \PDF::loadView('pdf.entrada', compact('data'));

        return $pdf->stream('entrada.pdf');
    }
}
