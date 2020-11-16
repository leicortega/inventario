<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index() {
        //
    }

    public function create(Request $request) {
        // dd($request);
        $cliente = Cliente::create([
            'name' => $request['name'],
            'identificacion' => $request['identificacion'],
            'email' => $request['email'],
            'telefono' => $request['telefono'],
            'direccion' => $request['direccion'],
        ]);

        if ($cliente->save()) {
            return ['create' => 1, 'cliente' => $cliente];
        }

        return ['create' => 0];
    }
}
