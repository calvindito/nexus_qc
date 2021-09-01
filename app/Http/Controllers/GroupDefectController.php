<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupDefectController extends Controller {
    
    public function index()
    {
        $data = [
            'title'   => 'Group Defect',
            'content' => 'master_data.general.group_defect'
        ];

        return view('layouts.index', ['data' => $data]);
    }

}
