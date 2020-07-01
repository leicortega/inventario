<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormCreateUserRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Exports\InformeExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use App\User;
use App\Models\Salida;
use App\Models\Entrada;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function users() {
        $users = User::paginate(10);

        return view('admin.users', ['users' => $users]);
    }

    public function createUser(FormCreateUserRequest $request) {

        $user = User::create([
            'name' => $request['name'],
            'identificacion' => $request['identificacion'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'estado' => $request['estado'],
        ]);

        if ($user->save()) {
            if ($request['tipo'] == 'admin') {
                $user->assignRole($request['tipo']);
            } else {
                $user->assignRole($request['tipo']);
                $user->givePermissionTo($request['permisos']);
            }
            return redirect()->route('users')->with('create', 1);
        } else {
            return redirect()->route('users')->with('create', 0);
        }
        
    }

    public function showUser(Request $request) {
        $user = User::find($request['id']);
        $permisos = array();

        foreach ($user->permissions as $permiso) {
            array_push($permisos, $permiso->name);
        }

        return [
            'user' => $user, 
            'rol' => $user->roles()->first()->name, 
            'permisos' => $permisos
        ];
    }

    public function updateUser(Request $request) {

        $user = User::find($request['id']);

        if ($request['password']) {
            $user->update([
                'password' => Hash::make($request['password'])
            ]);
        }

        $user->update([
            'name' => $request['name'],
            'identificacion' => $request['identificacion'],
            'email' => $request['email'],
            'estado' => $request['estado'],
        ]);

        if ($request['tipo'] == 'admin') {
            $user->assignRole($request['tipo']);
            $user->removeRole('general');
        } else {
            $user->assignRole($request['tipo']);
            $user->removeRole('admin');
            $user->revokePermissionTo(Permission::all());
            $user->givePermissionTo($request['permisos']);
        }
        return redirect()->route('users')->with('update', 1);
        
    }

    public function informe(Request $request) {

        $inicio = Str::substr($request['rango'], 0, 10);
        $fin = Str::substr($request['rango'], 13, 23);

        $data = [
            'salidas' => Salida::whereBetween('fecha', [$inicio, $fin])->with('detalle_salidas')->with('cliente')->with('vendedor')->get(),
            'entradas' => Entrada::whereBetween('fecha', [$inicio, $fin])->with('detalle_entradas')->with('proveedor')->with('vendedor')->get()
        ];
        
        // dd($data);
        return view('informes.excel', ['data' => $data]);
        // return Excel::download(new InformeExport($data), 'informe.xlsx');
    }
}
