
@if (isset($data['salidas']))
    <table style="border-collapse: collapse; border: 1px solid #000000 !important;" class="tg">
        <thead style="border: 1px solid #000000 !important;border-collapse: collapse;">
            <tr style="border: 1px solid #000000 !important;border-collapse: collapse;">
                <th style="border: 1px solid #000000 !important;background-color: #f0f0f0;border: 1px solid #000000 !important;color: #333333;font-family: Arial, sans-serif;font-size: 36px;font-weight: bold;overflow: hidden;padding: 6px 20px;text-align: center;vertical-align: top;word-break: normal;" colspan="5" >
                    Informe
                </th>
            </tr>
        </thead>
        <tbody style="border: 1px solid #000000 !important;border-collapse: collapse;">
            <tr style="border: 1px solid #000000 !important;border-collapse: collapse;">
                <td style="border: 1px solid #000000 !important;background-color: #c0c0c0;color: #333333;font-family: Arial, sans-serif;font-size: 14px;font-weight: bold;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                    Fecha
                </td>
                <td style="border: 1px solid #000000 !important;background-color: #c0c0c0;color: #333333;font-family: Arial, sans-serif;font-size: 14px;font-weight: bold;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                    Vendedor
                </td>
                <td style="border: 1px solid #000000 !important;background-color: #c0c0c0;color: #333333;font-family: Arial, sans-serif;font-size: 14px;font-weight: bold;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                    Cliente
                </td>
                <td style="border: 1px solid #000000 !important;background-color: #c0c0c0;color: #333333;font-family: Arial, sans-serif;font-size: 14px;font-weight: bold;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                    Tipo
                </td>
                <td style="border: 1px solid #000000 !important;background-color: #c0c0c0;color: #333333;font-family: Arial, sans-serif;font-size: 14px;font-weight: bold;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                    Total
                </td>
            </tr>
            
            @php
                $total_salidas = 0;
                $total_valor_salidas = 0;
            @endphp

            @foreach ($data['salidas'] as $salida)
                <tr style="border: 1px solid #000000 !important;border-collapse: collapse;">
                    <td style="border: 1px solid #000000 !important;color: #333333;font-family: Arial, sans-serif;font-size: 14px;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                        {{ $salida->fecha }}
                    </td>
                    <td style="border: 1px solid #000000 !important;color: #333333;font-family: Arial, sans-serif;font-size: 14px;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                        {{ $salida->vendedor->name }}
                    </td>
                    <td style="border: 1px solid #000000 !important;color: #333333;font-family: Arial, sans-serif;font-size: 14px;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                        {{ $salida->cliente->name }}
                    </td>
                    <td style="border: 1px solid #000000 !important;color: #333333;font-family: Arial, sans-serif;font-size: 14px;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                        Salida
                    </td>
                    <td style="border: 1px solid #000000 !important;color: #333333;font-family: Arial, sans-serif;font-size: 14px;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                        {{ $salida->total }}
                    </td>
                </tr>
                @php
                    $total_salidas = $total_salidas + 1;
                    $total_valor_salidas = $total_valor_salidas + $salida->total;
                @endphp
            @endforeach

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr style="border: 1px solid #000000 !important;border-collapse: collapse;">
                <td style="border: 1px solid #000000 !important;color: #333333;font-family: Arial, sans-serif;font-size: 14px;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                    
                </td>
                <td style="border: 1px solid #000000 !important;color: #333333;font-family: Arial, sans-serif;font-size: 14px;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                    Salidas
                </td>
                <td style="border: 1px solid #000000 !important;color: #333333;font-family: Arial, sans-serif;font-size: 14px;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                    {{ $total_salidas }}
                </td>
                <td style="border: 1px solid #000000 !important;color: #333333;font-family: Arial, sans-serif;font-size: 14px;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                    Total Salidas
                </td>
                <td style="border: 1px solid #000000 !important;color: #333333;font-family: Arial, sans-serif;font-size: 14px;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                    {{ $total_valor_salidas }}
                </td>
            </tr>
            
        </tbody>
    </table>
@else
    <table style="border-collapse: collapse; border: 1px solid #000000 !important;" class="tg">
        <thead style="border: 1px solid #000000 !important;border-collapse: collapse;">
            <tr style="border: 1px solid #000000 !important;border-collapse: collapse;">
                <th style="border: 1px solid #000000 !important;background-color: #f0f0f0;border: 1px solid #000000 !important;color: #333333;font-family: Arial, sans-serif;font-size: 36px;font-weight: bold;overflow: hidden;padding: 6px 20px;text-align: center;vertical-align: top;word-break: normal;" colspan="5" >
                    Informe
                </th>
            </tr>
        </thead>
        <tbody style="border: 1px solid #000000 !important;border-collapse: collapse;">
            <tr style="border: 1px solid #000000 !important;border-collapse: collapse;">
                <td style="border: 1px solid #000000 !important;background-color: #c0c0c0;color: #333333;font-family: Arial, sans-serif;font-size: 14px;font-weight: bold;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                    Fecha
                </td>
                <td style="border: 1px solid #000000 !important;background-color: #c0c0c0;color: #333333;font-family: Arial, sans-serif;font-size: 14px;font-weight: bold;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                    Proveedor
                </td>
                <td style="border: 1px solid #000000 !important;background-color: #c0c0c0;color: #333333;font-family: Arial, sans-serif;font-size: 14px;font-weight: bold;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                    Usuario
                </td>
                <td style="border: 1px solid #000000 !important;background-color: #c0c0c0;color: #333333;font-family: Arial, sans-serif;font-size: 14px;font-weight: bold;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                    Tipo
                </td>
                <td style="border: 1px solid #000000 !important;background-color: #c0c0c0;color: #333333;font-family: Arial, sans-serif;font-size: 14px;font-weight: bold;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                    Total
                </td>
            </tr>

            @php
                $total_entradas = 0;
                $total_valor_entradas = 0;
            @endphp
            
            @foreach ($data['entradas'] as $entrada)
                <tr style="border: 1px solid #000000 !important;border-collapse: collapse;">
                    <td style="border: 1px solid #000000 !important;color: #333333;font-family: Arial, sans-serif;font-size: 14px;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                        {{ $entrada->fecha }}
                    </td>
                    <td style="border: 1px solid #000000 !important;color: #333333;font-family: Arial, sans-serif;font-size: 14px;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                        {{ $entrada->proveedor->name }}
                    </td>
                    <td style="border: 1px solid #000000 !important;color: #333333;font-family: Arial, sans-serif;font-size: 14px;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                        {{ $entrada->vendedor->name }}
                    </td>
                    <td style="border: 1px solid #000000 !important;color: #333333;font-family: Arial, sans-serif;font-size: 14px;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                        Entrada
                    </td>
                    <td style="border: 1px solid #000000 !important;color: #333333;font-family: Arial, sans-serif;font-size: 14px;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                        {{ $entrada->total }}
                    </td>
                </tr>
                @php
                    $total_entradas = $total_entradas + 1;
                    $total_valor_entradas = $total_valor_entradas + $entrada->total;
                @endphp
            @endforeach

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr style="border: 1px solid #000000 !important;border-collapse: collapse;">
                <td style="border: 1px solid #000000 !important;color: #333333;font-family: Arial, sans-serif;font-size: 14px;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                    
                </td>
                <td style="border: 1px solid #000000 !important;color: #333333;font-family: Arial, sans-serif;font-size: 14px;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                    Entradas
                </td>
                <td style="border: 1px solid #000000 !important;color: #333333;font-family: Arial, sans-serif;font-size: 14px;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                    {{ $total_entradas }}
                </td>
                <td style="border: 1px solid #000000 !important;color: #333333;font-family: Arial, sans-serif;font-size: 14px;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                    Total Entradas
                </td>
                <td style="border: 1px solid #000000 !important;color: #333333;font-family: Arial, sans-serif;font-size: 14px;overflow: hidden;padding: 6px 20px;text-align: left;vertical-align: top;word-break: normal;" >
                    {{ $total_valor_entradas }}
                </td>
            </tr>
            
        </tbody>
    </table>
@endif


