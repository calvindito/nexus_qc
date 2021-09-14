<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'Dashboard',
            'content' => 'dashboard'
        ];

        return view('layouts.index', ['data' => $data]);
    }

}
