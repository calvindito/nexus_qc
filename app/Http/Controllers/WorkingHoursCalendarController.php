<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkingHoursChart;
use App\Http\Controllers\Controller;

class WorkingHoursCalendarController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'Working Hours - Calendar',
            'content' => 'working_hours.calendar'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function loadData()
    {
        $result = [];
        $data = WorkingHoursChart::whereNotNull('start_date')
            ->whereNotNull('end_date')
            ->orderBy('created_at', 'asc')
            ->get();

        foreach($data as $d) {
            $start_date = strtotime($d->start_date);
            $end_date   = strtotime($d->end_date);
            $now        = strtotime(date('Y-m-d'));

            if($now >= $start_date && $now <= $end_date) {
                $bg_color = '#25B372';
            } else if($now < $start_date) {
                $bg_color = '#45748A';
            } else {
                $bg_color = '#EF5350';
            }

            $result[] = [
                'id'              => $d->id,
                'start'           => $d->start_date,
                'end'             => $d->end_date,
                'title'           => $d->workingHoursType->name,
                'url'             => 'javascript:void(0);',
                'display'         => 'auto',
                'backgroundColor' => $bg_color,
                'borderColor'     => $bg_color,
                'textColor'       => '#ffffff'
            ];
        }

        return response()->json($result);
    }

    public function detail(Request $request)
    {
        $schedule_detail = [];
        $data            = WorkingHoursChart::find($request->id);

        foreach($data->workingHoursType->workingHoursTypeDetail as $key => $whtd) {
            if($whtd->status == 1) {
                $total_work_hours = $whtd->differenceTime()->working[0] . ' Hours ' . $whtd->differenceTime()->working[1] . ' Minutes';
            } else {
                $total_work_hours = '-';
            }

            $schedule_detail[] = [
                'class'            => $whtd->status == 1 ? '' : 'text-white bg-danger',
                'status'           => $whtd->status(),
                'work_start_time'  => $whtd->work_start_time ? date('H:i', strtotime($whtd->work_start_time)) : '-',
                'work_end_time'    => $whtd->work_end_time ? date('H:i', strtotime($whtd->work_end_time)) : '-',
                'break_start_time' => $whtd->break_start_time ? date('H:i', strtotime($whtd->break_start_time)) : '-',
                'break_end_time'   => $whtd->break_end_time ? date('H:i', strtotime($whtd->break_end_time)) : '-',
                'total_work_hours' => $total_work_hours
            ];
        }

        return response()->json([
            'name'            => $data->workingHoursType->name,
            'company'         => $data->company ? $data->company->name : '-',
            'branch'          => $data->branch ? $data->branch->description : '-',
            'division'        => $data->division ? $data->division->divisi : '-',
            'departement'     => $data->departement ? $data->departement->department : '-',
            'section'         => $data->section ? $data->section->name : '-',
            'line'            => $data->line ? $data->line->name : '-',
            'schedule_detail' => $schedule_detail
        ]);
    }

}
