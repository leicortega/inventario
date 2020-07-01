@section('title') Proveedores @endsection

@extends('layouts.app')

@section('content')
<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row p-xl-5 p-md-3">                   
                            <div class="table-responsive mb-3" id="Resultados">

                                @if ($errors->any())
                                    <div class="alert alert-danger mb-0" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if (session()->has('create') && session('create') == 1)
                                    <div class="alert alert-success">
                                        El Proveedor se creo correctamente.
                                    </div>
                                @endif

                                @if (session()->has('update') && session('update') == 1)
                                    <div class="alert alert-success">
                                        El Proveedor se actualizo correctamente.
                                    </div>
                                @endif
                                
                                @if (session()->has('create') && session('create') == 0)
                                    <div class="alert alert-danger">
                                        Ocurrio un error, contacte al desarrollador.
                                    </div>
                                @endif

                                <button type="button" class="btn btn-primary mb-2 mr-2 waves-effect waves-light" data-toggle="modal" data-target="#modal-create-proveedor"><i class="mdi mdi-plus mr-1"></i> Agregar</button>

                                <table class="table table-centered table-hover table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th colspan="12" class="text-center">
                                                <div class="d-inline-block icons-sm mr-2"><i class="uim uim-layer-group"></i></div>
                                                <span class="header-title mt-2">Proveedores</span>
                                            </th>
                                        </tr>
                                        <!--Parte de busqueda de datos-->
                                        <tr>
                                            <th colspan="12" class="text-center">
                                                {{-- <form action="/dashboard/programacion-viaje/get-ciudades" method="get" class="d-inline-block w-50">
                                                    @csrf

                                                    <div class="row col-12 text-center">
                                                        <div class="styled-select col-5">
                                                            <select class="form-control required" id="ciudad_origen" name="ciudad_origen" required onchange="ciudadDestino(this.value)">
                                                                <option value="">Ciudad Origen</option>
                                                            </select>
                                                        </div>
                                                        <div class="styled-select col-5">
                                                            <select class="form-control required" id="ciudad_destino" name="ciudad_destino" required>
                                                                <option value="">Ciudad Destino</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-2">
                                                            <button type="submit" class="btn btn-primary">Buscar</button>
                                                            
                                                        </div>
                                                    </div>
                                                </form> --}}
                                            </th>
                                        </tr>
                                        <!--Fin parte de busqueda de datos-->
                                        <tr>
                                            <th scope="col">N°</th>
                                            <th scope="col">Nit</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Telefono</th>
                                            <th scope="col">Direccion</th>
                                            <th scope="col">Regimen</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($proveedores as $proveedor)
                                            <tr>
                                                <th scope="row">
                                                    <a href="#">{{ $proveedor->id }}</a>
                                                </th>
                                                <td>{{ $proveedor->nit }}</td>
                                                <td>{{ $proveedor->name }}</td>
                                                <td>{{ $proveedor->telefono }}</td>
                                                <td>{{ $proveedor->direccion }}</td>
                                                <td>{{ $proveedor->regimen }}</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="showProveedor({{ $proveedor->id }})" data-toggle="tooltip" data-placement="top" title="Editar Usuario">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>

                            {{ $proveedores->links() }}
                            
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- end row -->

    </div> <!-- container-fluid -->
</div>

<div class="modal fade bs-example-modal-lg" id="modal-create-proveedor" tabindex="-1" role="dialog" aria-labelledby="modal-blade-title" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Crear Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/proveedores/create" method="POST">
                    @csrf

                    <div class="form-group row">
                        <label for="nit" class="col-sm-2 col-form-label">Nit</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="nit" placeholder="Escriba el nit" />
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="name" placeholder="Escriba el nombre" required />
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="telefono" placeholder="Escriba el telefono" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="direccion" placeholder="Escriba la direccion" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="regimen" class="col-sm-2 col-form-label">Regimen</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="regimen" required>
                                <option value="">Seleccione el regimen</option>
                                <option value="Común">Común</option>
                                <option value="Simplificado">Simplificado</option>
                                <option value="Especial">Especial</option>
                            </select>
                        </div>
                    </div>
                
                    <div class="mt-3">
                        <button class="btn btn-primary btn-lg waves-effect waves-light" type="submit">Crear</button>
                    </div> 
                
                </form>
            </div>
        </div>
    </div>
</div>
@endsection







