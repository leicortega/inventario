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
                        <div class="row col-12 justify-content-center">
                            <ul class="nav nav-pills">
                                <li class="nav-item uim-icon-dark">
                                    <a class="nav-link active" href="/productos/historial/salidas/{{$salidas[0]->productos->id ?? $entradas[0]->productos->id ?? ''}}">
                                        <i class="uim uim-exit font-size-18 mr-1 align-middle"></i> <span class="d-none d-md-inline-block">Salidas</span>
                                    </a>
                                </li>
                                <li class="nav-item uim-icon-dark">
                                    <a class="nav-link" href="/productos/historial/entradas/{{$salidas[0]->productos->id ?? $entradas[0]->productos->id ?? ''}}">
                                        <i class="uim uim-entry font-size-18 mr-1 align-middle"></i> <span class="d-none d-md-inline-block">Entradas</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="row p-xl-5 p-md-3">                   
                            <div class="table-responsive mb-3" id="Resultados">

                                <table class="table table-centered table-hover table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th colspan="12" class="text-center">
                                                <div class="d-inline-block icons-sm mr-2"><i class="uim uim-exit"></i></div>
                                                <span class="header-title mt-2">Historial salidas producto <b>{{$salidas[0]->productos->name ?? ''}}</b></span>
                                            </th>
                                        </tr>
                                        <!--Parte de busqueda de datos-->
                                        <tr>
                                            <th colspan="12" class="text-center">
                                                
                                            </th>
                                        </tr>
                                        <!--Fin parte de busqueda de datos-->
                                        <tr>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Cliente</th>
                                            <th scope="col">Vendedor</th>
                                            <th scope="col">Producto</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($salidas as $row_salida)
                                            <tr>
                                                <td>{{ $row_salida->salida->fecha }}</td>
                                                <td>{{ \App\Models\Cliente::find($row_salida->salida->clientes_id)->first()->name }}</td>
                                                <td>{{ \App\User::find($row_salida->salida->users_id)->first()->name }}</td>
                                                <td>{{ $row_salida->productos->name }}</td>
                                                <td>{{ $row_salida->cantidad }}</td>
                                                <td>{{ $row_salida->precio }}</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="showSalida({{ $row_salida->salida->id }})" data-toggle="tooltip" data-placement="top" title="Ver Factura">
                                                        <i class="mdi mdi-file-document-box-search-outline"></i>
                                                    </button>
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
@endsection

@section('MainScript')
    <script>
        $(document).ready(function () {
            $(".selectize").selectize();
        })
    </script>
@endsection





