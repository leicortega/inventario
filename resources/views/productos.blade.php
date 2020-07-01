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
                                        El Producto se creo correctamente.
                                    </div>
                                @endif

                                @if (session()->has('delete') && session('delete') == 1)
                                    <div class="alert alert-success">
                                        El Proveedor se elimino correctamente.
                                    </div>
                                @endif

                                @if (session()->has('add') && session('add') == 1)
                                    <div class="alert alert-success">
                                        El agrego el Proveedor correctamente.
                                    </div>
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

                                <button type="button" class="btn btn-primary mb-2 mr-2 waves-effect waves-light" data-toggle="modal" data-target="#modal-create-producto"><i class="mdi mdi-plus mr-1"></i> Agregar</button>

                                <table class="table table-centered table-hover table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th colspan="12" class="text-center">
                                                <div class="d-inline-block icons-sm mr-2"><i class="uim uim-airplay"></i></div>
                                                <span class="header-title mt-2">Productos</span>
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
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Proveedor</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productos as $producto)
                                            <tr>
                                                <th scope="row">
                                                    <a href="#">{{ $producto->id }}</a>
                                                </th>
                                                <td>{{ $producto->name }}</td>
                                                <td>{{ $producto->cantidad }}</td>
                                                <td>{{ $producto->precio }}</td>
                                                <td>{{ \App\Models\Proveedores_producto::where('productos_id', $producto->id)->with('proveedor')->first()->proveedor->name ?? '' }}</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="showProducto({{ $producto->id }})" data-toggle="tooltip" data-placement="top" title="Editar Producto">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-info btn-sm" onclick="historialProducto({{ $producto->id }})" data-toggle="tooltip" data-placement="top" title="Historial de producto">
                                                        <i class="mdi mdi-file-document-box-search-outline"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>

                            {{ $productos->links() }}
                            
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- end row -->

    </div> <!-- container-fluid -->
</div>
<div class="modal fade bs-example-modal-sm" id="modal-delete-proveedor" tabindex="-1" role="dialog" aria-labelledby="modal-blade-title" aria-hidden="true" style="z-index:1080 !important;">
    <div class="modal-dialog modal-sm zindex-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Eliminar Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/productos/delete/proveedor" method="POST">
                    @csrf
                    
                    <h3 class="text-center">¿Seguro desea eliminar el proveedor?</h3>

                    <input class="form-control d-none" type="number" name="id_producto_delete" id="id_producto_delete"  />
                    <input class="form-control d-none" type="number" name="id_proveedor_delete" id="id_proveedor_delete"  />
                
                    <div class="mt-3 text-center">
                        <button class="btn btn-dark btn-lg waves-effect waves-light" data-dismiss="modal" aria-label="Close" type="button">Cancelar</button>
                    
                        <button class="btn btn-danger btn-lg waves-effect waves-light" type="submit">Eliminar</button>
                    </div> 
                
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-lg" id="modal-create-producto" tabindex="-1" role="dialog" aria-labelledby="modal-blade-title" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Crear Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/productos/create" method="POST">
                    @csrf

                    {{-- <div class="form-group row">
                        <label for="code" class="col-sm-2 col-form-label">Codigo de barras</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="code" placeholder="Escriba el Codigo de barras" />
                        </div>
                    </div> --}}
                
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="name" placeholder="Escriba el nombre" required />
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label for="cantidad" class="col-sm-2 col-form-label">Cantidad</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="cantidad" placeholder="Escriba la cantidad" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="precio" class="col-sm-2 col-form-label">Precio</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="precio" placeholder="Escriba el precio" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="descripcion" placeholder="Escriba la descripcion" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="iva" class="col-sm-2 col-form-label">Porcentaje IVA</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="iva" placeholder="Escriba el iva" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="proveedores_id" class="col-sm-2 col-form-label">Proveedor</label>
                        <div class="col-sm-10">
                            <select class="selectize" name="proveedores_id" id="proveedores_id" required>
                                <option value="">Seleccione el proveedor</option>
                                @foreach (\App\Models\Proveedor::all() as $proveedor)
                                    <option value="{{ $proveedor->id }}">{{ $proveedor->name }}</option>
                                @endforeach
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

@section('MainScript')
    <script>
        $(document).ready(function () {
            $(".selectize").selectize();
        })
    </script>
@endsection





