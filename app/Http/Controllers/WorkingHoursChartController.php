<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkingHoursChartController extends Controller {

    public function index()
    {
        $data = [
            'title'     => 'Working Hours - Chart',
            'tree_view' => treeViewWorkingHoursChart(),
            'content'   => 'working_hours.chart'
        ];

        return view('layouts.index', ['data' => $data]);
    }

}
