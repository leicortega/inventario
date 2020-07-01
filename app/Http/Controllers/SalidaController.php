<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Salida;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Detalle_salida;
use Illuminate\Http\Request;

class SalidaController extends Controller
{
    
    public function index() {
        $salidas = Salida::orderBy('fecha', 'desc')->paginate(10);

        return view('salidas', ['salidas' => $salidas]);
    }

    public function searchCliente(Request $request) {
        $cliente = Cliente::where('identificacion', $request['id'])->first();

        if (empty($cliente)) {
            $data = ['existe' => 0];
        } else {
            $data = ['existe' => 1, 'id' => $cliente->id, 'identificacion' => $cliente->identificacion, 'nombre' => $cliente->name];
        }

        return $data;
    }

    public function addProducto(Request $request) {
        return Producto::find($request['id']);
    }

    public function create(Request $request) {
        $date = Carbon::now('America/Bogota');
        $errors = 0;

        if ($request['total_productos'] == 1) {
            $productos_cantidad = 1;
        } else {
            $productos_cantidad = $request['total_productos'] - 1;
        }

        $salida = Salida::create([
            'fecha' => $date->toDateTimeString(),
            'total' => $request['total_salida_input'],
            'clientes_id' => $request['id_cliente'],
            'users_id' => auth()->user()->id,
        ]);

        if ($salida->save()) {
            for ($i=1; $i <= $productos_cantidad; $i++) { 
                $producto = Producto::find($request['id_producto_'.$i]);

                $detalle_salida = Detalle_salida::create([
                    'cantidad' => $request['cantidad_producto_'.$i],
                    'precio' => $producto->precio,
                    'productos_id' => $producto->id,
                    'salidas_id' => $salida->id,
                ]);

                if(!$detalle_salida->save()){
                    $errors = $errors++;
                }

                $stock = ($producto->cantidad - $request['cantidad_producto_'.$i]);

                $producto->update([
                    'cantidad' => $stock
                ]);
            }
        }

        if ($errors == 0) {
            return redirect()->route('salidas')->with('create', 1)->with('salida', $salida->id);
        } else {
            return redirect()->route('salidas')->with('create', 0);
        }
    }
    
    public function showSalida(Request $request) {
        $salida = Salida::with('detalle_salidas')->where('id', $request['id'])->get();

        foreach ($salida as $key) {
            foreach ($key->detalle_salidas as $row) {
                $id_producto = $row->productos_id;
                $row['nombre_producto'] = Producto::find($id_producto)->name;
            }
        }

        $data = [
            'id_factura' => $salida[0]->id,
            'fecha' => $salida[0]->fecha,
            'cliente' => Cliente::find($salida[0]->clientes_id),
            'vendedor' => auth()->user()->name,
            'productos' => $salida[0]->detalle_salidas,
            'total' => $salida[0]->total
        ];

        return $data;
    }

    public function printSalida(Request $request) {
        $salida = Salida::with('detalle_salidas')->where('id', $request['id'])->get();

        foreach ($salida as $key) {
            foreach ($key->detalle_salidas as $row) {
                $id_producto = $row->productos_id;
                $row['nombre_producto'] = Producto::find($id_producto)->name;
            }
        }

        $data = [
            'id_factura' => $salida[0]->id,
            'fecha' => $salida[0]->fecha,
            'cliente' => Cliente::find($salida[0]->clientes_id),
            'vendedor' => auth()->user()->name,
            'productos' => $salida[0]->detalle_salidas,
            'total' => $salida[0]->total
        ];

        $pdf = \PDF::loadView('pdf.salida', compact('data'));

        return $pdf->stream('salida.pdf');
    }

}
