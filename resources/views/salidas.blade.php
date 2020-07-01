@section('title') Productos @endsection

@extends('layouts.app')

@section('CSSPlugins') <link href="{{ asset('assets/libs/selectize/css/selectize.css') }}" rel="stylesheet" type="text/css" /> @endsection
@section('JsPlugins') <script src="{{ asset('assets/libs/selectize/js/standalone/selectize.min.js') }}"></script> @endsection

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
                                        La salida se creo correctamente.
                                    </div>
                                    @php
                                        echo '<script>window.open("/salidas/print/'.session('salida').'")</script>';
                                    @endphp
                                @endif

                                @if (session()->has('update') && session('update') == 1)
                                    <div class="alert alert-success">
                                        El Producto se actualizo correctamente.
                                    </div>
                                @endif
                                
                                @if (session()->has('create') && session('create') == 0)
                                    <div class="alert alert-danger">
                                        Ocurrio un error, contacte al desarrollador.
                                    </div>
                                @endif

                                <button type="button" class="btn btn-primary mb-2 mr-2 waves-effect waves-light" data-toggle="modal" data-target="#modal-create-salida"><i class="mdi mdi-plus mr-1"></i> Crear</button>

                                <table class="table table-centered table-hover table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th colspan="12" class="text-center">
                                                <div class="d-inline-block icons-sm mr-2"><i class="uim uim-exit"></i></div>
                                                <span class="header-title mt-2">Salidas</span>
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
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Cliente</th>
                                            <th scope="col">Vendedor</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($salidas as $salida)
                                            <tr>
                                                <th scope="row">
                                                    <a href="#">{{ $salida->id }}</a>
                                                </th>
                                                <td>{{ $salida->fecha }}</td>
                                                <td>{{ \App\Models\Cliente::find($salida->clientes_id)->name }}</td>
                                                <td>{{ \App\User::find($salida->users_id)->name }}</td>
                                                <td>{{ $salida->total }}</td>
                                                {{-- <td>{{ \App\Models\Proveedor::find($producto->proveedores_id)->name }}</td> --}}
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="showSalida({{ $salida->id }})" data-toggle="tooltip" data-placement="top" title="Mostrar Factura">
                                                        <i class="mdi mdi-eye"></i>
                                                    </button>
                                                    <a href="/salidas/print/{{$salida->id}}" target="_blank"><button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Imprimir Factura">
                                                        <i class="mdi mdi-printer"></i>
                                                    </button></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>

                            {{ $salidas->links() }}
                            
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- end row -->

    </div> <!-- container-fluid -->
</div>

<div class="modal fade bs-example-modal-lg" id="modal-create-salida" tabindex="-1" role="dialog" aria-labelledby="modal-blade-title" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Crear Salida</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/salidas/create" method="POST" id="form_create_salida">
                    @csrf
                
                    <div class="form-group row">
                        <label for="indentificacion_cliente" class="col-sm-2 col-form-label">Cliente</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="indentificacion_cliente" id="indentificacion_cliente" placeholder="Escriba la identificación" required />
                            <input type="hidden" name="id_cliente" id="id_cliente"  />
                        </div>
                    </div>

                    <hr>
                
                    <div class="form-group row">
                        <label for="producto" class="col-sm-2 col-form-label">Productos</label>
                        <div class="col-6">
                            <select class="selectize" name="producto_id" id="producto_id">
                                <option value="">Seleccione el producto</option>
                                @foreach (\App\Models\Producto::all() as $producto)
                                    <option value="{{ $producto->id }}">{{ $producto->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <input class="form-control" type="number" name="producto_cantidad" id="producto_cantidad" placeholder="Escriba la cantidad" />
                        </div>
                        <div class="col-1">
                            <button class="btn btn-info waves-effect waves-light" type="button" onclick="addProducto()"><i class="mdi mdi-plus mr-1"></i></button>
                        </div> 
                    </div>

                    <div class="form-group" id="content_productos">
                        
                    </div>

                    <div class="form-group">
                        <div class="row mt-5">
                            <div class="col-10 text-right">Total: </div>
                            <div class="col-2 text-right" id="total_salida">0</div>
                            <input type="hidden" name="total_salida_input" id="total_salida_input" value="0" />
                        </div>
                    </div>
                
                    <input type="hidden" name="total_productos" id="total_productos" value="1" />
                    
                    <div class="mt-3">
                        <button class="btn btn-primary btn-lg waves-effect waves-light" type="submit">Crear</button>
                    </div>  
                
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('MainScript')
    <script>
        $(document).ready(function () {
            $(".selectize").selectize();
        })
    </script>
@endsection





