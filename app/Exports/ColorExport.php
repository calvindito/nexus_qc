<?php

namespace App\Exports;

use App\Models\Color;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ColorExport implements FromView, ShouldAutoSize {

    use Exportable;

    public function __construct()
    {
        ini_set('memory_limit', '-1');
    }

    public function view(): View
    {
        return view('excel.color', ['data' => Color::all()]);
    }

}
