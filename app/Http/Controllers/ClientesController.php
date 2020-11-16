<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cliente;

class ClientesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $clientes = Cliente::paginate(10);

        return view('clientes', ['clientes' => $clientes]);
    }

    public function show(Request $request) {
        $cliente = Cliente::find($request['id']);

        return [
            'cliente' => $cliente,
        ];
    }

    public function create(Request $request) {
        Validator::make($request->all(), [
            'identificacion' => 'unique:clientes,identificacion'
        ], $messages = [
            'unique'    => 'La :attribute ya esta registrada'
        ])->validate();

        $cliente = Cliente::create($request->all());

        if ($cliente->save()) {
            return redirect()->back()->with(['create' => 1]);
        }

        return redirect()->back()->with(['create' => 0]);
    }

    public function update(Request $request) {

        $cliente = Cliente::find($request['id']);

        $cliente->update([
            'identificacion' => $request['identificacion'],
            'name' => $request['name'],
            'telefono' => $request['telefono'],
            'direccion' => $request['direccion'],
        ]);

        return redirect()->back()->with('update', 1);

    }

    public function buscar(Request $request) {
        $clientes = Cliente::where('name', 'LIKE', '%'.$request['buscar'].'%')->orWhere('identificacion', 'LIKE', '%'.$request['buscar'].'%')->orWhere('telefono', 'LIKE', '%'.$request['buscar'].'%')->paginate(10);

        return view('clientes', ['clientes' => $clientes]);
    }
}
