<?php

namespace App\Http\Controllers;

use App\Helper\Emba;
use Illuminate\Http\Request;

class WorkingHoursChartController extends Controller {

    public function index()
    {
        // dd(Emba::treeViewWorkingHoursChart());

        $data = [
            'title'     => 'Working Hours - Chart',
            // 'tree_view' => Emba::treeViewWorkingHoursChart(),
            'content'   => 'working_hours.chart'
        ];

        return view('layouts.index', ['data' => $data]);
    }

}
