<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {

    public function index()
    {
        dd(DB::connection('asset')->table('city')->count());

        $data = [
            'title'   => 'Dashboard',
            'content' => 'dashboard'
        ];

        return view('layouts.index', ['data' => $data]);
    }

}
