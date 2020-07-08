<?php

namespace App\Exports\Sheets;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use App\Models\Salida;
use App\Models\Entrada;

class InformePerSheet implements FromView, WithTitle, ShouldAutoSize
{

    private $inicio;
    private $fin;
    private $hoja;
    
    public function __construct($inicio, $fin, $hoja)
    {
        $this->inicio = $inicio;
        $this->fin = $fin;
        $this->hoja = $hoja;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View {
        if ($this->hoja == 1) {
            $data = [
                'salidas' => Salida::whereBetween('fecha', [$this->inicio, $this->fin])->with('detalle_salidas')->with('cliente')->with('vendedor')->get(),
            ];
            return view('informes.excel', [
                'data' => $data
            ]);
        } else {
            $data = [
                'entradas' => Entrada::whereBetween('fecha', [$this->inicio, $this->fin])->with('detalle_entradas')->with('proveedor')->with('vendedor')->get()
            ];
            return view('informes.excel', [
                'data' => $data
            ]);
        }
    }

    public function title(): string {
        if ($this->hoja == 1) {
            return 'Salidas';
        } else {
            return 'Entradas';
        }
    }
}
