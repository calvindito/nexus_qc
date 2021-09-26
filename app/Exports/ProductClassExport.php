<?php

namespace App\Exports;

use App\Models\ProductClass;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductClassExport implements FromView, ShouldAutoSize {

    use Exportable;

    public function __construct()
    {
        ini_set('memory_limit', '-1');
    }

    public function view(): View
    {
        return view('excel.class_product', ['data' => ProductClass::all()]);
    }

}
