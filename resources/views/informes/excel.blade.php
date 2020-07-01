

<h1 style="font-family: 'proxima-nova',sans-serif;letter-spacing: -0.01em;font-weight: 700;font-style: normal;font-size: 60px;margin-left: -3px;line-height: 1em;color: #000000;text-align: center;margin-bottom: 8px;text-rendering: optimizeLegibility;">Informe</h1>

<div style="border: 1px solid #000000 !important;border-collapse: collapse; display:flex;">
    
    <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" style="border-collapse:collapse;border-color:#000000; margin">
        <thead style="border: 1px solid #000000 !important;border-collapse: collapse;">
            {{-- <tr><th colspan=""></th></tr> --}}
            <tr style="border: 1px solid #000000 !important;border-collapse: collapse;">
                <th rowspan="1" colspan="5" style="text-align:center;border: 1px solid #000000 !important;border-collapse: collapse;">Salidas</th>
            </tr>
            <tr style="border: 1px solid #000000 !important;border-collapse: collapse;">
                <th rowspan="1" style="text-align:center;border: 1px solid #000000 !important;border-collapse: collapse;">Fecha</th>
                <th rowspan="1" style="text-align:center;border: 1px solid #000000 !important;border-collapse: collapse;">Vendedor</th>
                <th rowspan="1" style="text-align:center;border: 1px solid #000000 !important;border-collapse: collapse;">Cliente</th>
                <th rowspan="1" style="text-align:center;border: 1px solid #000000 !important;border-collapse: collapse;">Tipo</th>
                <th rowspan="1" style="text-align:center;border: 1px solid #000000 !important;border-collapse: collapse;">Total</th>
            </tr>
        </thead>
        <tbody style="border: 1px solid #000000 !important;border-collapse: collapse;">
            
            @foreach ($data['salidas'] as $salida)
                <tr style="border: 1px solid #000000 !important;border-collapse: collapse;">
                    <td style="border: 1px solid #000000 !important;border-collapse: collapse;">{{ $salida->fecha }}</td>
                    <td style="border: 1px solid #000000 !important;border-collapse: collapse;">{{ $salida->vendedor->name }}</td>
                    <td style="border: 1px solid #000000 !important;border-collapse: collapse;">{{ $salida->cliente->name }}</td>
                    <td style="border: 1px solid #000000 !important;border-collapse: collapse;">Salida</td>
                    <td style="border: 1px solid #000000 !important;border-collapse: collapse;">{{ $salida->total }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" style="border-collapse:collapse;border-color:#000000;">
        <thead style="border: 1px solid #000000 !important;border-collapse: collapse;">
            {{-- <tr><th colspan=""></th></tr> --}}
            <tr style="border: 1px solid #000000 !important;border-collapse: collapse;">
                <th rowspan="1" colspan="5" style="text-align:center;border: 1px solid #000000 !important;border-collapse: collapse;">Entradas</th>
            </tr>
            <tr style="border: 1px solid #000000 !important;border-collapse: collapse;">
                <th rowspan="1" style="text-align:center;border: 1px solid #000000 !important;border-collapse: collapse;">Fecha</th>
                <th rowspan="1" style="text-align:center;border: 1px solid #000000 !important;border-collapse: collapse;">Proveedor</th>
                <th rowspan="1" style="text-align:center;border: 1px solid #000000 !important;border-collapse: collapse;">Usuario</th>
                <th rowspan="1" style="text-align:center;border: 1px solid #000000 !important;border-collapse: collapse;">Tipo</th>
                <th rowspan="1" style="text-align:center;border: 1px solid #000000 !important;border-collapse: collapse;">Total</th>
            </tr>
        </thead>
        <tbody style="border: 1px solid #000000 !important;border-collapse: collapse;">

            @foreach ($data['entradas'] as $entrada)
                <tr style="border: 1px solid #000000 !important;border-collapse: collapse;">
                    <td style="border: 1px solid #000000 !important;border-collapse: collapse;">{{ $entrada->fecha }}</td>
                    <td style="border: 1px solid #000000 !important;border-collapse: collapse;">{{ $entrada->proveedor->name }}</td>
                    <td style="border: 1px solid #000000 !important;border-collapse: collapse;">{{ $entrada->vendedor->name }}</td>
                    <td style="border: 1px solid #000000 !important;border-collapse: collapse;">Entrada</td>
                    <td style="border: 1px solid #000000 !important;border-collapse: collapse;">{{ $entrada->total }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>