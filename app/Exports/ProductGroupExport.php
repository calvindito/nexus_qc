<?php

namespace App\Exports;

use App\Models\ProductGroup;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class ProductGroupExport extends StringValueBinder implements FromView, ShouldAutoSize, WithCustomValueBinder {

    use Exportable;

    public function __construct()
    {
        ini_set('memory_limit', '-1');
    }

    public function view(): View
    {
        return view('excel.group_product', ['data' => ProductGroup::all()]);
    }

}
