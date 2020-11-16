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
                                    <div class="alert alert-danger mb-2" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if (session()->has('create') && session('create') == 1)
                                    <div class="alert alert-success">
                                        El Cliente se creo correctamente.
                                    </div>
                                @endif

                                @if (session()->has('update') && session('update') == 1)
                                    <div class="alert alert-success">
                                        El Cliente se actualizo correctamente.
                                    </div>
                                @endif

                                @if (session()->has('create') && session('create') == 0)
                                    <div class="alert alert-danger">
                                        Ocurrio un error, contacte al desarrollador.
                                    </div>
                                @endif

                                <button type="button" class="btn btn-primary mb-2 mr-2 waves-effect waves-light" data-toggle="modal" data-target="#modal-create-cliente"><i class="mdi mdi-plus mr-1"></i> Agregar</button>

                                <table class="table table-centered table-hover table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th colspan="12" class="text-center">
                                                <div class="d-inline-block icons-sm mr-2"><i class="uim uim-layer-group"></i></div>
                                                <span class="header-title mt-2">Clientes</span>
                                            </th>
                                        </tr>
                                        <!--Parte de busqueda de datos-->
                                        <tr>
                                            <th colspan="12" class="text-center">
                                                <form action="/clientes/buscar" method="post" class="d-inline-block w-50">
                                                    @csrf

                                                    <div class="row col-12 text-center">
                                                        <div class="styled-select col-8">
                                                            <input type="text" name="buscar" id="buscar" class="form-control" placeholder="Buscar...">
                                                        </div>
                                                        <div class="col-2">
                                                            <button type="submit" class="btn btn-primary">Buscar</button>

                                                        </div>
                                                    </div>
                                                </form>
                                            </th>
                                        </tr>
                                        <!--Fin parte de busqueda de datos-->
                                        <tr>
                                            <th scope="col">N°</th>
                                            <th scope="col">Identificacion</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Telefono</th>
                                            <th scope="col">Direccion</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clientes as $cliente)
                                            <tr>
                                                <th scope="row">
                                                    <a href="#">{{ $cliente->id }}</a>
                                                </th>
                                                <td>{{ $cliente->identificacion }}</td>
                                                <td>{{ $cliente->name }}</td>
                                                <td>{{ $cliente->telefono }}</td>
                                                <td>{{ $cliente->direccion }}</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="showCliente({{ $cliente->id }})" data-toggle="tooltip" data-placement="top" title="Editar Cliente">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                            {{ $clientes->links() }}

                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- end row -->

    </div> <!-- container-fluid -->
</div>

<div class="modal fade bs-example-modal-lg" id="modal-create-cliente" tabindex="-1" role="dialog" aria-labelledby="modal-blade-title" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="modal-title-cliente">Crear Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-content-cliente">
                <form action="/clientes/create" method="POST">
                    @csrf

                    <div class="form-group row">
                        <label for="identificacion" class="col-sm-2 col-form-label">Identificacion</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="identificacion" placeholder="Escriba la identificación" required/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="name" placeholder="Escriba el nombre" required />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="correo" class="col-sm-2 col-form-label">Correo</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="email" name="correo" placeholder="Escriba el correo" />
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

                    <div class="mt-3">
                        <button class="btn btn-primary btn-lg waves-effect waves-light" type="submit">Crear</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection







