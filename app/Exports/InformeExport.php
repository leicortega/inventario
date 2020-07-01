<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class InformeExport implements FromView
{
    use Exportable;

    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function view() : View
    {
        return view('informes.excel', ['data' => $this->data]);
    }
}
