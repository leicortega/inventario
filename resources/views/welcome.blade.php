@section('title') Dashnoard @endsection

@extends('layouts.app')

@section('content')
<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h5>Bienvenido</h5>
                                <p class="text-muted">{{ Auth::user()->name }}</p>
                            </div>
                        </div>
                        <div class="row mt-5">

                            @canany(['entradas', 'universal'])
                                <div class="col-lg-3">
                                    <div class="card border shadow-none">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="icons-md mr-3">
                                                    <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-primary" d="M20,11H11.41406l2.293-2.293A.99989.99989,0,0,0,12.293,7.293l-4,4a.99962.99962,0,0,0,0,1.41406l4,4A.99989.99989,0,0,0,13.707,15.293L11.41406,13H20Z"></path><path class="uim-tertiary" d="M11.41406,11H20V5a3.00328,3.00328,0,0,0-3-3H7A3.00328,3.00328,0,0,0,4,5V19a3.00328,3.00328,0,0,0,3,3H17a3.00328,3.00328,0,0,0,3-3V13H11.41406l2.293,2.293A.99989.99989,0,1,1,12.293,16.707l-4-4a.99962.99962,0,0,1,0-1.41406l4-4A.99989.99989,0,0,1,13.707,8.707Z"></path></svg></span>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="mb-1">Entradas</h5>
                                                    {{-- <p class="text-muted">If several languages coalesce</p> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer text-center">
                                            <a href="#">Ir a Entradas</a>
                                        </div>
                                    </div>
                                </div>
                            @endcanany

                            @canany(['salidas', 'universal'])
                                <div class="col-lg-3">
                                    <div class="card border shadow-none">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="icons-md mr-3">
                                                    <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-primary" d="M15.707,11.293l-4-4A.99989.99989,0,0,0,10.293,8.707L12.58594,11H4v2h8.58594l-2.293,2.293A.99989.99989,0,1,0,11.707,16.707l4-4A.99962.99962,0,0,0,15.707,11.293Z"></path><path class="uim-tertiary" d="M17,2H7A3.00328,3.00328,0,0,0,4,5v6h8.58594L10.293,8.707A.99989.99989,0,0,1,11.707,7.293l4,4a.99962.99962,0,0,1,0,1.41406l-4,4A.99989.99989,0,0,1,10.293,15.293L12.58594,13H4v6a3.00328,3.00328,0,0,0,3,3H17a3.00328,3.00328,0,0,0,3-3V5A3.00328,3.00328,0,0,0,17,2Z"></path></svg></span>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="mb-1">Salidas</h5>
                                                    {{-- <p class="text-muted">Neque porro quisquam est</p> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer text-center">
                                            <a href="#">Ir a Salidas</a>
                                        </div>
                                    </div>
                                </div>
                            @endcanany

                            @canany(['productos', 'universal'])
                                <div class="col-lg-3">
                                    <div class="card border shadow-none">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="icons-md mr-3">
                                                    <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><rect width="20" height="15" x="2" y="3" class="uim-tertiary" rx="3"></rect><path class="uim-primary" d="M16,21H8a.99992.99992,0,0,1-.832-1.55469l4-6a1.03785,1.03785,0,0,1,1.66406,0l4,6A.99992.99992,0,0,1,16,21Z"></path></svg></span>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="mb-1">Productos</h5>
                                                    {{-- <p class="text-muted">Sed ut perspiciatis unde</p> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer text-center">
                                            <a href="#">Ir a Productos</a>
                                        </div>
                                    </div>
                                </div>
                            @endcanany

                            @canany(['proveedores', 'universal'])
                                <div class="col-lg-3">
                                    <div class="card border shadow-none">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="icons-md mr-3">
                                                    <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-quaternary" d="M12,14.19531a1.00211,1.00211,0,0,1-.5-.13379l-9-5.19726a1.00032,1.00032,0,0,1,0-1.73242l9-5.19336a1.00435,1.00435,0,0,1,1,0l9,5.19336a1.00032,1.00032,0,0,1,0,1.73242l-9,5.19726A1.00211,1.00211,0,0,1,12,14.19531Z"></path><path class="uim-tertiary" d="M21.5,11.13184,19.53589,9.99847,12.5,14.06152a1.0012,1.0012,0,0,1-1,0L4.46411,9.99847,2.5,11.13184a1.00032,1.00032,0,0,0,0,1.73242l9,5.19726a1.0012,1.0012,0,0,0,1,0l9-5.19726a1.00032,1.00032,0,0,0,0-1.73242Z"></path><path class="uim-primary" d="M21.5,15.13184l-1.96411-1.13337L12.5,18.06152a1.0012,1.0012,0,0,1-1,0L4.46411,13.99847,2.5,15.13184a1.00032,1.00032,0,0,0,0,1.73242l9,5.19726a1.0012,1.0012,0,0,0,1,0l9-5.19726a1.00032,1.00032,0,0,0,0-1.73242Z"></path></svg></span>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="mb-1">Proveedores</h5>
                                                    {{-- <p class="text-muted">Sed ut perspiciatis unde</p> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer text-center">
                                            <a href="#">Ir a Proveedores</a>
                                        </div>
                                    </div>
                                </div>
                            @endcanany
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
</div>

<div class="modal fade bs-example-modal-sm" id="modal-informe" tabindex="-1" role="dialog" aria-labelledby="modal-blade-title" aria-hidden="true" style="z-index:1050 !important;">
    <div class="modal-dialog modal-sm zindex-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Generar informe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/informe" method="GET">
                    @csrf
                    
                    <h4 class="text-center p-2">Seleccione el rango de fechas</h4>

                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <input type="text" autocomplete="off" class="form-control datepicker-here" name="rango" data-range="true" data-date-format="yyyy-mm-dd" data-multiple-dates-separator=" - " data-language="es" />
                        </div>
                    </div>
                
                    <div class="mt-3 text-center">                    
                        <button class="btn btn-primary btn-lg waves-effect waves-light" type="submit">Enviar</button>
                    </div> 
                
                </form>
            </div>
        </div>
    </div>
</div>
@endsection