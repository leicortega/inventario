<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="invoice-title">
                <div class="row" style="display: flex;flex-wrap: wrap;">
                    <div class="col-6">
                        <h2>Factura</h2>
                    </div>
                    <div class="col-6 text-right" style="text-align: right!important;">
                        <h3 class="pull-right">Orden #{{ $data['id_factura'] }}</h3>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <address>
                        <strong>Fecha y hora:</strong><br>
                        {{ $data['fecha'] }}<br><br>
                    </address>
                </div>
            </div>
            <div class="row" style="display: flex;flex-wrap: wrap;">
                <div class="col-6">
                    <address>
                        <strong>Nombre Empresa</strong><br>
                        Direccion<br>
                        Telefono<br>
                        Correo<br><br>
                        <strong>Vendedor:</strong><br>
                        {{ $data['vendedor'] }}
                    </address>
                </div>
                <div class="col-6 text-right" style="text-align: right!important;">
                    <address>
                    <strong>Cliente:</strong><br>
                        {{ $data['usuario']['name'] }}<br>
                        {{ $data['usuario']['identificacion'] }}<br>
                        {{ $data['usuario']['telefono'] }}<br>
                        {{ $data['usuario']['direccion'] }}<br>
                    </address>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center" style="text-align: center!important;padding: 1rem;"><strong>Resumen de factura</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed" style="width: 100%;margin-bottom: 1rem;">
                            <thead>
                                <tr>
                                    <td><strong>Producto</strong></td>
                                    <td class="text-center" style="text-align: center!important;"><strong>Precio U.</strong></td>
                                    <td class="text-center" style="text-align: center!important;"><strong>Cantidad</strong></td>
                                    <td class="text-right" style="text-align: right!important;"><strong>Total</strong></td>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data['productos'] as $item)
                                    <tr style="margin-bottom: 1rem;">
                                        <td style="margin-bottom: 1rem;border-top: 1px solid #2f3e46;padding: .75rem;">{{ $item['nombre_producto'] }}</td>
                                        <td style="margin-bottom: 1rem;border-top: 1px solid #2f3e46;text-align: center!important;padding: .75rem;">${{ $item['precio'] }}</td>
                                        <td style="margin-bottom: 1rem;border-top: 1px solid #2f3e46;text-align: center!important;padding: .75rem;">{{ $item['cantidad'] }}</td>
                                        <td style="margin-bottom: 1rem;border-top: 1px solid #2f3e46;text-align: right!important;padding: .75rem;">${{ $item['precio'] * $item['cantidad'] }}</td>
                                    </tr>
                                @endforeach
                                
                                <tr style="margin-bottom: 1rem;">
                                    <td style="margin-bottom: 1rem;border-top: 1px solid #2f3e46;padding: .75rem;" class="thick-line"></td>
                                    <td style="margin-bottom: 1rem;border-top: 1px solid #2f3e46;padding: .75rem;" class="thick-line"></td>
                                    <td style="margin-bottom: 1rem;border-top: 1px solid #2f3e46;text-align: center!important;text-align: right!important;padding: .75rem;"><strong>Subtotal</strong></td>
                                    <td style="margin-bottom: 1rem;border-top: 1px solid #2f3e46;text-align: center!important;text-align: right!important;padding: .75rem;">${{ $data['total'] }}</td>
                                </tr>
                                <tr style="margin-bottom: 1rem;">
                                    <td style="margin-bottom: 1rem;padding: .75rem;" class="no-line"></td>
                                    <td style="margin-bottom: 1rem;padding: .75rem;" class="no-line"></td>
                                    <td style="margin-bottom: 1rem;border-top: 1px solid #2f3e46;text-align: center!important;text-align: right!important;padding: .75rem;"><strong>IVA</strong></td>
                                    <td style="margin-bottom: 1rem;border-top: 1px solid #2f3e46;text-align: center!important;text-align: right!important;padding: .75rem;">$0</td>
                                </tr>
                                <tr style="margin-bottom: 1rem;">
                                    <td style="margin-bottom: 1rem;padding: .75rem;" class="no-line"></td>
                                    <td style="margin-bottom: 1rem;padding: .75rem;" class="no-line"></td>
                                    <td style="margin-bottom: 1rem;border-top: 1px solid #2f3e46;text-align: center!important;text-align: right!important;padding: .75rem;"><strong>Total</strong></td>
                                    <td style="margin-bottom: 1rem;border-top: 1px solid #2f3e46;text-align: center!important;text-align: right!important;padding: .75rem;">${{ $data['total'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>