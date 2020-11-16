$(document).ready(function () {
    if (window.location.pathname == '/proveedores/create') {
        $('#modal-create-proveedor').modal('show');
    }

    if (window.location.pathname == '/clientes/create') {
        $('#modal-create-cliente').modal('show');
    }

    if (window.location.pathname == '/productos/create') {
        $('#modal-create-producto').modal('show');
    }

    if (window.location.pathname == '/salidas/create') {
        $('#modal-create-salida').modal('show');
    }

    if (window.location.pathname == '/entradas/create') {
        $('#modal-create-entrada').modal('show');
    }

    $("#indentificacion_cliente").blur(function() {
        var id = $("#indentificacion_cliente").val();

        $.ajax({
            url: '/salidas/search/cliente/'+id,
            type: 'get',
            success: function (data) {
                if (data.existe == 1) {
                    $("#indentificacion_cliente").prop("type", "text");
                    $('#indentificacion_cliente').val(data.identificacion+' - '+data.nombre)
                    $('#id_cliente').val(data.id)
                } else {
                    $('#modal-blade').modal('show');
                    $('#modal-blade-title').html('Crear Cliente');

                    var content = `
                        <div class="alert alert-danger d-none" id="alert-createCliente">Ocurrio un error, recargue la pagina.</div>

                        <form id="form_createCliente" method="POST" >

                            <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="name" placeholder="Escriba el nombre" required />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="identificacion" class="col-sm-2 col-form-label">Identificacion</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="number" name="identificacion" id="identificacion_createCliente" placeholder="Escriba la identificacion" required />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Correo (opcional)</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="email" name="email" placeholder="Escriba el correo" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telefono" class="col-sm-2 col-form-label">Telefono (opcional)</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="number" name="telefono" placeholder="Escriba el telefono" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="direccion" class="col-sm-2 col-form-label">Direccion (opcional)</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="direccion" placeholder="Escriba la direccion" />
                                </div>
                            </div>

                            <div class="mt-3">
                                <button class="btn btn-primary btn-lg waves-effect waves-light" type="button" onclick="createCliente()" id="btn-createCliente">Crear</button>
                            </div>

                        </form>`;

                    $('#modal-blade-body').html(content);
                    $('#identificacion_createCliente').val(id)
                }
            }
        });
    });

    $('#crear_entrada').submit(function () {
        var producto_exists = $('#crear_entrada').serializeArray()[5].value
        if(producto_exists > 0){
            return true
        } else {
            $('#crear_entrada_danger').removeClass('d-none')
            return false
        }
    })

    $('#form_create_salida').submit(function () {
        console.log('si')
    })

});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function showUser(id) {
    $.ajax({
        url: '/admin/users/show/'+id,
        type: 'get',
        success: function (data) {
            $('#modal-blade').modal('show');
            $('#modal-blade-title').html(data.user.name);

            var content = `

                <form action="/admin/users/update" method="POST" >

                    <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                    <input type="hidden" name="id" value="${data.user.id}">

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="name" placeholder="Escriba el nombre" value="${data.user.name}" required />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="identificacion" class="col-sm-2 col-form-label">Identificacion</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="identificacion" placeholder="Escriba la identificacion" value="${data.user.identificacion}" required />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Correo (opcional)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="email" name="email" placeholder="Escriba el correo" value="${(data.user.email) ? data.user.email : ''}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="estado" class="col-sm-2 col-form-label">Estado</label>
                        <div class="col-sm-10">
                            <select name="estado" id="estado" class="form-control" required>
                                <option value="">Seleccione el estado</option>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" name="password" placeholder="Escriba la contraseña" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tipo" class="col-sm-2 col-form-label">Tipo</label>
                        <div class="col-sm-10">
                            <select name="tipo" id="tipo" id="tipo" class="form-control" onchange="selectTipo(this.value)" required>
                                <option value="">Seleccione el tipo</option>
                                <option value="admin">admin</option>
                                <option value="general">general</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row ${(data.rol == 'admin') ? 'd-none' : ''} divPermisos">
                        <label for="permiso" class="col-sm-2 col-form-label">Permiso</label>
                        <div class="col-sm-10 mt-2">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="custominlineCheck11" name="permisos[]" value="universal" ${data.permisos.includes('universal') ? 'checked=""' : ''}>
                                <label class="custom-control-label" for="custominlineCheck11">Universal</label>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="custominlineCheck22" name="permisos[]" value="entradas" ${data.permisos.includes('entradas') ? 'checked=""' : ''}>
                                <label class="custom-control-label" for="custominlineCheck22">Entradas</label>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="custominlineCheck33" name="permisos[]" value="salidas" ${data.permisos.includes('salidas') ? 'checked=""' : ''}>
                                <label class="custom-control-label" for="custominlineCheck33">Salidas</label>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="custominlineCheck44" name="permisos[]" value="productos" ${data.permisos.includes('productos') ? 'checked=""' : ''}>
                                <label class="custom-control-label" for="custominlineCheck44">Productos</label>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="custominlineCheck55" name="permisos[]" value="proveedores" ${data.permisos.includes('proveedores') ? 'checked=""' : ''}>
                                <label class="custom-control-label" for="custominlineCheck55">Proveedores</label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-primary btn-lg waves-effect waves-light" type="submit">Actualizar</button>
                    </div>

                </form>`;

            $('#modal-blade-body').html(content);

            $('#estado').val(data.user.estado);
            $('#tipo').val(data.rol);

        }
    });
}

function showProveedor(id) {
    $.ajax({
        url: '/proveedores/show/'+id,
        type: 'get',
        success: function (data) {
            $('#modal-blade').modal('show');
            $('#modal-blade-title').html(data.proveedor.name);

            var content = `

                <form action="/proveedores/update" method="POST">

                    <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                    <input type="hidden" name="id" value="${data.proveedor.id}">

                    <div class="form-group row">
                        <label for="nit" class="col-sm-2 col-form-label">Nit</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="nit" placeholder="Escriba el nit" value="${(data.proveedor.nit) ? data.proveedor.nit : ''}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="name" placeholder="Escriba el nombre" value="${data.proveedor.name}" required />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="telefono" placeholder="Escriba el telefono" value="${(data.proveedor.telefono) ? data.proveedor.telefono : ''}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="direccion" placeholder="Escriba la direccion" value="${(data.proveedor.direccion) ? data.proveedor.direccion : ''}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="regimen" class="col-sm-2 col-form-label">Regimen</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="regimen" id="regimen" required>
                                <option value="">Seleccione el regimen</option>
                                <option value="Común">Común</option>
                                <option value="Simplificado">Simplificado</option>
                                <option value="Especial">Especial</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-primary btn-lg waves-effect waves-light" type="submit">Actualizar</button>
                    </div>

                </form>`;

            $('#modal-blade-body').html(content);
            $('#regimen').val(data.proveedor.regimen);

        }
    });
}

function showCliente(id) {
    $.ajax({
        url: '/clientes/show/'+id,
        type: 'get',
        success: function (data) {
            console.log(data)
            $('#modal-create-cliente').modal('show');
            $('#modal-title-cliente').html('Actualizar '+data.cliente.name);

            var content = `

                <form action="/clientes/update" method="POST">

                    <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                    <input type="hidden" name="id" value="${data.cliente.id}">

                    <div class="form-group row">
                        <label for="identificacion" class="col-sm-2 col-form-label">Identificacion</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="identificacion" placeholder="Escriba el identificacion" value="${data.cliente.identificacion}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="name" placeholder="Escriba el nombre" value="${data.cliente.name}" required />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="telefono" placeholder="Escriba el telefono" value="${(data.cliente.telefono) ? data.cliente.telefono : ''}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="direccion" placeholder="Escriba la direccion" value="${(data.cliente.direccion) ? data.cliente.direccion : ''}" />
                        </div>
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-primary btn-lg waves-effect waves-light" type="submit">Actualizar</button>
                    </div>

                </form>`;

            $('#modal-content-cliente').html(content);

        }
    });
}

function showProducto(id) {
    $.ajax({
        url: '/productos/show/'+id,
        type: 'get',
        success: function (data) {
            console.log(data)
            $('#modal-blade').modal('show');
            $('#modal-blade-title').html(data.producto.name);

            var content = `

                <form action="/productos/update" method="POST">

                    <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                    <input type="hidden" name="id" value="${data.producto.id}">

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="name" placeholder="Escriba el nombre" required value="${data.producto.name}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cantidad" class="col-sm-2 col-form-label">Cantidad</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="cantidad" placeholder="Escriba la cantidad" value="${data.producto.cantidad}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="precio" class="col-sm-2 col-form-label">Precio</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="precio" placeholder="Escriba el precio" value="${data.producto.precio}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="descripcion" placeholder="Escriba la descripcion" value="${(data.producto.descripcion) ? data.producto.descripcion : '' }" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="iva" class="col-sm-2 col-form-label">IVA %</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="iva" placeholder="Escriba el iva" value="${(data.producto.iva) ? data.producto.iva : '' }" />
                        </div>
                    </div>`;

                    data.proveedores_producto.forEach(proveedores => {
                        content += `
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Proveedor</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" disabled value="${proveedores.proveedor.name}" />
                                </div>
                                <div class="col-sm-1">
                                    <button type="button" class="btn btn-danger" onclick="eliminarProveedor(${proveedores.proveedores_id}, ${proveedores.productos_id})"><i class="mdi mdi-trash-can-outline"></i></button>
                                </div>
                            </div>
                        `;
                    });



                content += `
                    <div class="mt-3 text-center">
                        <button class="btn btn-primary btn-lg waves-effect waves-light" type="submit">Actualizar</button>
                    </div>

                </form>

                <hr>
                <form action="/productos/add/proveedor" method="POST">

                    <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                    <input type="hidden" name="id_producto_add" value="${data.producto.id}">

                    <div class="form-group row">
                        <label for="id_proveedores_add" class="col-sm-2 col-form-label">Agregar Proveedor</label>
                        <div class="col-sm-9">
                            <select class="selectize form-control" name="id_proveedores_add" id="id_proveedores_add" required>
                                <option value="">Seleccione el proveedor</option>`;

                                    data.proveedores.forEach(proveedor => {
                                        content += `<option value="${proveedor.id}" ${(proveedor.id == data.producto.proveedores_id) ? 'selected' : ''}>${proveedor.name}</option>`;
                                    });

                        content += `</select>
                        </div>
                        <div class="col-sm-1">
                            <button type="submit" class="btn btn-info"><i class="mdi mdi-plus"></i></button>
                        </div>
                    </div>

                </form> `;

            $('#modal-blade-body').html(content);

        }
    });
}

function historialProducto(id) {
    window.location.href = '/productos/historial/salidas/'+id
}

function showSalida(id) {
    $.ajax({
        url: '/salidas/show/salida/'+id,
        type: 'get',
        success: function (data) {

            $('#modal-blade').modal('show');
            $('#modal-blade-title').html('Detalle de factura #'+data.id_factura);

            var content = `

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="invoice-title">
                                <div class="row">
                                    <div class="col-6">
                                        <h2>Factura</h2>
                                    </div>
                                    <div class="col-6 text-right">
                                        <h3 class="pull-right">Orden #${data.id_factura}</h3>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <address>
                                        <strong>Fecha y hora:</strong><br>
                                        ${data.fecha}<br><br>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <address>
                                        <strong>Nombre Empresa</strong><br>
                                        Direccion<br>
                                        Telefono<br>
                                        Correo<br><br>
                                        <strong>Vendedor:</strong><br>
                                        ${data.vendedor}
                                    </address>
                                </div>
                                <div class="col-6 text-right">
                                    <address>
                                    <strong>Cliente:</strong><br>
                                        ${data.cliente.name}<br>
                                        ${data.cliente.identificacion}<br>
                                        ${data.cliente.telefono ?? ''}<br>
                                        ${data.cliente.direccion ?? ''}<br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title text-center"><strong>Resumen de factura</strong></h3>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-condensed">
                                            <thead>
                                                <tr>
                                                    <td><strong>Producto</strong></td>
                                                    <td class="text-center"><strong>Precio U.</strong></td>
                                                    <td class="text-center"><strong>Cantidad</strong></td>
                                                    <td class="text-right"><strong>Total</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>`

                                            data.productos.forEach(producto => {
                                                content += `
                                                    <tr>
                                                        <td>${producto.nombre_producto}</td>
                                                        <td class="text-center">$${producto.precio}</td>
                                                        <td class="text-center">${producto.cantidad}</td>
                                                        <td class="text-right">$${(parseInt(producto.precio) * parseInt(producto.cantidad))}</td>
                                                    </tr>
                                                `;
                                            });

                                            content += `
                                                <tr>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                                    <td class="thick-line text-right">$${data.total}</td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-center"><strong>IVA</strong></td>
                                                    <td class="no-line text-right">$0</td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-center"><strong>Total</strong></td>
                                                    <td class="no-line text-right">$${data.total}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            $('#modal-blade-body').html(content);

        }
    });
}

function selectTipo(tipo) {
    if (tipo == 'general') {
        $('.divPermisos').removeClass('d-none')
    } else {
        $('.divPermisos').addClass('d-none')
    }
}

function createCliente() {
    $.ajax({


        url: '/clientes/create/ajax',
        type: 'post',
        data: $('#form_createCliente').serialize(),
        success: function (data) {
            if (data.create == 1) {
                $("#indentificacion_cliente").prop("type", "text");
                $('#indentificacion_cliente').val(data.cliente.identificacion+' - '+data.cliente.name)
                $('#id_cliente').val(data.cliente.id)
                $('#modal-blade').modal('hide');
            } else {
                $('#alert-createCliente').removeClass('d-none')
            }
        }
    });

    return false;
}

function addProducto() {
    var id = $('#producto_id').val()
    var cantidad = $('#producto_cantidad').val()
    var total_productos = $('#total_productos').val()
    var total = $('#total_salida_input').val();

    $.ajax({
        url: '/salidas/add/producto/'+id,
        type: 'get',
        success: function (data) {
            if (data) {
                var content = $('#content_productos').html()
                content += `
                    <hr class="mt-5">
                    <div class="row">
                        <div class="col-8">${data.name}</div>
                        <div class="col-1">${cantidad}</div>
                        <div class="col-3 text-right">${data.precio*cantidad}</div>
                    </div>
                    <input type="hidden" name="id_producto_${total_productos}" value="${data.id}" />
                    <input type="hidden" name="cantidad_producto_${total_productos}" value="${cantidad}" />
                `;

                $('#producto_id').val('-1').addClass('active').selected = true
                $('#producto_cantidad').val('')
                $('#total_productos').val(parseInt(total_productos) + 1)
                $('#content_productos').html(content)
                total = parseInt(total) + (data.precio*cantidad)
                $('#total_salida').html(total)
                $('#total_salida_input').val(total)
            }
        }
    })
}

function selectProveedor(id) {
    $.ajax({
        url: '/entradas/list/productos/'+id,
        type: 'get',
        success: function (data) {
            var content = '<option value="">Seleccione el producto</option>';
            data.forEach(producto => {
                content += `<option value="${producto.productos.id}">${producto.productos.name}</option>`;
            });

            $('#producto_id').html(content);
        }
    })
}

function addProductoEntrada() {
    var id = $('#producto_id').val()
    var nombre = $('select[name="producto_id"] option:selected').text()
    var cantidad = $('#producto_cantidad').val()
    var precio = $('#producto_precio').val()
    var total_productos = $('#total_productos').val()
    var total = $('#total_entrada_input').val();

    var content = $('#content_productos').html()
    content += `
        <hr class="mt-5">
        <div class="row">
            <div class="col-8">${nombre}</div>
            <div class="col-1">${cantidad}</div>
            <div class="col-3 text-right">${precio*cantidad}</div>
        </div>
        <input type="hidden" name="id_producto_${total_productos}" value="${id}" />
        <input type="hidden" name="cantidad_producto_${total_productos}" value="${cantidad}" />
        <input type="hidden" name="precio_producto_${total_productos}" value="${precio}" />
    `;
    $('#content_productos').html(content)

    $('#producto_id').val('').addClass('active').selected = true
    $('#producto_cantidad').val('')
    $('#producto_precio').val('')

    total = parseInt(total) + (precio*cantidad)
    $('#total_entrada').html(total)
    $('#total_entrada_input').val(total)

    $('#total_productos').val(parseInt(total_productos) + 1)
}

function showEntrada(id) {
    $.ajax({
        url: '/entradas/show/entrada/'+id,
        type: 'get',
        success: function (data) {

            $('#modal-blade').modal('show');
            $('#modal-blade-title').html('Detalle de entrada #'+data.id_factura);

            var content = `

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="invoice-title">
                                <div class="row">
                                    <div class="col-6">
                                        <h2>Detalle de Entrada</h2>
                                    </div>
                                    <div class="col-6 text-right">
                                        <h3 class="pull-right">Orden #${data.id_factura}</h3>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <address>
                                        <strong>Fecha y hora:</strong><br>
                                        ${data.fecha}<br><br>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <address>
                                        <strong>Nombre Empresa</strong><br>
                                        Direccion<br>
                                        Telefono<br>
                                        Correo<br><br>
                                        <strong>Usuario:</strong><br>
                                        ${data.usuario}
                                    </address>
                                </div>
                                <div class="col-6 text-right">
                                    <address>
                                    <strong>Proveedor:</strong><br>
                                        ${data.proveedor.name}<br>
                                        ${data.proveedor.identificacion}<br>
                                        ${data.proveedor.telefono ?? ''}<br>
                                        ${data.proveedor.direccion ?? ''}<br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title text-center"><strong>Resumen de entrada</strong></h3>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-condensed">
                                            <thead>
                                                <tr>
                                                    <td><strong>Producto</strong></td>
                                                    <td class="text-center"><strong>Precio U.</strong></td>
                                                    <td class="text-center"><strong>Cantidad</strong></td>
                                                    <td class="text-right"><strong>Total</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>`

                                            data.productos.forEach(producto => {
                                                content += `
                                                    <tr>
                                                        <td>${producto.nombre_producto}</td>
                                                        <td class="text-center">$${producto.precio}</td>
                                                        <td class="text-center">${producto.cantidad}</td>
                                                        <td class="text-right">$${(parseInt(producto.precio) * parseInt(producto.cantidad))}</td>
                                                    </tr>
                                                `;
                                            });

                                            content += `
                                                <tr>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                                    <td class="thick-line text-right">$${data.total}</td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-center"><strong>IVA</strong></td>
                                                    <td class="no-line text-right">$0</td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-center"><strong>Total</strong></td>
                                                    <td class="no-line text-right">$${data.total}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            $('#modal-blade-body').html(content);

        }
    });
}

function eliminarProveedor(proveedor, producto) {
    $('#modal-delete-proveedor').modal('show')
    $('#id_producto_delete').val(producto)
    $('#id_proveedor_delete').val(proveedor)
}

