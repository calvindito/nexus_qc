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
        switch($this->param) {
            case '1':
                $view = 'group_defect';
                break;
            case '2':
                $view = 'sub_group_defect';
                break;
            case '3':
                $view = 'defect_list';
                break;
            case '4':
                $view = 'reject_list';
                break;
            case '5':
                $view = 'major_defect_list';
                break;
            case '6':
                $view = 'critical_defect_list';
                break;
            default:
                $view = '';
                break;
        }

        return view('excel.' . $view, ['data' => GroupDefect::where('type', $this->param)->get()]);
    }

}
