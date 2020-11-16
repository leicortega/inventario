
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li class="mb-3">
                    <a href="/" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-window-grid"></i></div>
                        <span>Dashboard</span>
                    </a>
                </li>

                @if ( Request::is('/') )

                    <li class="menu-title">Modulos</li>

                    @canany(['entradas', 'universal'])
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-entry"></i></div>
                                <span>Entradas</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="entradas/create">Crear</a></li>
                                <li><a href="entradas/list">Lista de Entradas</a></li>
                            </ul>
                        </li>
                    @endcanany

                    @canany(['salidas', 'universal'])
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-exit"></i></div>
                                <span>Salidas</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="salidas/create">Crear</a></li>
                                <li><a href="salidas/list">Lista de Salidas</a></li>
                            </ul>
                        </li>
                    @endcanany

                    @canany(['productos', 'universal'])
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                                <span>Productos</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="productos/create">Crear</a></li>
                                <li><a href="productos/list">Lista de Productos</a></li>
                            </ul>
                        </li>
                    @endcanany

                    @canany(['proveedores', 'universal'])
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-layer-group"></i></div>
                                <span>Proveedores</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="proveedores/create">Crear</a></li>
                                <li><a href="proveedores/list">Lista de Proveedores</a></li>
                            </ul>
                        </li>
                    @endcanany

                    @canany(['clientes', 'universal'])
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-record-audio"></i></div>
                                <span>Clientes</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="clientes/create">Crear</a></li>
                                <li><a href="clientes/list">Lista de Clientes</a></li>
                            </ul>
                        </li>
                    @endcanany

                    @canany(['universal'])

                        <li class="menu-title">Administrador</li>

                        <li>
                            <a href="admin/users" class=" waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-object-group"></i></div>
                                <span>Usuarios</span>
                            </a>
                        </li>

                        <li>
                            <a href="#" data-toggle="modal" data-target="#modal-informe"  class=" waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-analysis"></i></div>
                                <span>Informe</span>
                            </a>
                        </li>

                    @endcanany

                @endif

                @if ( Request::is('admin/users') || Request::is('admin/users/*') )

                    <li class="menu-title">Usuarios</li>

                    <li>
                        <a href="/admin/users" class="waves-effect">
                            <div class="d-inline-block icons-sm"></div>
                            <span>Lista de Usuarios</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" data-toggle="modal" data-target="#modal-create-user" class="waves-effect">
                            <div class="d-inline-block icons-sm"></div>
                            <span>Crear</span>
                        </a>
                    </li>

                @endif

                @if ( Request::is('proveedores/') || Request::is('proveedores/*') )

                    <li class="menu-title">Proveedores</li>

                    {{-- <li>
                        <a href="/admin/users" class="waves-effect">
                            <div class="d-inline-block icons-sm"></div>
                            <span>Lista de Usuarios</span>
                        </a>
                    </li> --}}

                    <li>
                        <a href="#" data-toggle="modal" data-target="#modal-create-proveedor" class="waves-effect">
                            <div class="d-inline-block icons-sm"></div>
                            <span>Crear</span>
                        </a>
                    </li>

                @endif

                @if ( Request::is('clientes/') || Request::is('clientes/*') )

                    <li class="menu-title">Clientes</li>

                    {{-- <li>
                        <a href="/admin/users" class="waves-effect">
                            <div class="d-inline-block icons-sm"></div>
                            <span>Lista de Usuarios</span>
                        </a>
                    </li> --}}

                    <li>
                        <a href="#" data-toggle="modal" data-target="#modal-create-cliente" class="waves-effect">
                            <div class="d-inline-block icons-sm"></div>
                            <span>Crear</span>
                        </a>
                    </li>

                @endif

                @if ( Request::is('productos/') || Request::is('productos/*') )

                    <li class="menu-title">Productos</li>

                    <li>
                        <a href="#" data-toggle="modal" data-target="#modal-create-producto" class="waves-effect">
                            <div class="d-inline-block icons-sm"></div>
                            <span>Crear</span>
                        </a>
                    </li>

                    <li>
                        <a href="/productos/list" class="waves-effect">
                            <div class="d-inline-block icons-sm"></div>
                            <span>Lista de Productos</span>
                        </a>
                    </li>

                @endif

                @if ( Request::is('salidas/') || Request::is('salidas/*') )

                    <li class="menu-title">Salidas</li>

                    {{-- <li>
                        <a href="/admin/users" class="waves-effect">
                            <div class="d-inline-block icons-sm"></div>
                            <span>Lista de Usuarios</span>
                        </a>
                    </li> --}}

                    <li>
                        <a href="#" data-toggle="modal" data-target="#modal-create-salida" class="waves-effect">
                            <div class="d-inline-block icons-sm"></div>
                            <span>Crear</span>
                        </a>
                    </li>

                @endif

                @if ( Request::is('entradas/') || Request::is('entradas/*') )

                    <li class="menu-title">Entradas</li>

                    {{-- <li>
                        <a href="/admin/users" class="waves-effect">
                            <div class="d-inline-block icons-sm"></div>
                            <span>Lista de Usuarios</span>
                        </a>
                    </li> --}}

                    <li>
                        <a href="#" data-toggle="modal" data-target="#modal-create-entrada" class="waves-effect">
                            <div class="d-inline-block icons-sm"></div>
                            <span>Crear</span>
                        </a>
                    </li>

                @endif

            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>

