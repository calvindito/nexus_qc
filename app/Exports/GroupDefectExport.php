<?php

namespace App\Exports;

use App\Models\GroupDefect;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class GroupDefectExport implements FromView, ShouldAutoSize {

    use Exportable;

    protected $param;

    public function __construct($param)
    {
        $this->param = $param;
        ini_set('memory_limit', '-1');
    }

    public function view(): View
    {
        return view('excel.color', ['data' => GroupDefect::where('type', $this->param)->get()]);
    }

}
