<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;

class DashboardController extends Controller {

    public function index()
    {
        $activity_chart = [];
        for($i = 1; $i <= 12; $i++) {
            $date  = date('Y-' . sprintf('%02s', $i));
            $month = date('m', strtotime($date));
            $index = strtolower(date('M', strtotime($date)));

            $activity_chart[$index] = ActivityLog::where('causer_id', session('id'))
                ->whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $month)
                ->count();
        }

        $data = [
            'title'          => 'Dashboard',
            'activity_chart' => $activity_chart,
            'activity'       => ActivityLog::where('causer_id', session('id'))->orderByDesc('id')->limit(6)->get(),
            'content'        => 'dashboard'
        ];

        return view('layouts.index', ['data' => $data]);
    }

}
