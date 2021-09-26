<?php

namespace App\Exports;

use App\Models\Size;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SizeExport implements FromView, ShouldAutoSize {

    use Exportable;

    public function __construct()
    {
        ini_set('memory_limit', '-1');
    }

    public function view(): View
    {
        return view('excel.size', ['data' => Size::all()]);
    }

}
