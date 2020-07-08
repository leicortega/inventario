<?php

namespace App\Exports;

use App\Exports\Sheets\InformePerSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class InformeExport implements WithMultipleSheets
{
    use Exportable;

    private $inicio;
    private $fin;
    
    public function rango($inicio, $fin)
    {
        $this->inicio = $inicio;
        $this->fin = $fin;

        return $this;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        for ($hoja = 1; $hoja <= 2; $hoja++) {
            $sheets[] = new InformePerSheet($this->inicio, $this->fin, $hoja);
        }

        return $sheets;
    }
}
