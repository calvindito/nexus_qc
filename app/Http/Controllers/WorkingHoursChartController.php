<?php

namespace App\Http\Controllers;

use App\Models\Line;
use App\Models\Section;
use App\Models\Division;
use App\Models\Departement;
use App\Models\SisterBranch;
use Illuminate\Http\Request;
use App\Models\SisterCompany;
use App\Models\WorkingHoursType;
use App\Models\WorkingHoursChart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class WorkingHoursChartController extends Controller {

    public function index()
    {
        $data = [
            'title'     => 'Working Hours - Chart',
            'tree_view' => treeViewWorkingHoursChart(),
            'wht'       => WorkingHoursType::where('status', 1)->get(),
            'content'   => 'working_hours.chart'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request)
    {
        $column = [
            'id',
            'working_hours_type_id',
            'start_date',
            'end_date',
            'total_working_day',
            'total_holiday',
            'total_working_hours'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = WorkingHoursChart::count();

        $query_data = WorkingHoursChart::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->whereHas('workingHoursType', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            });
                    });
                }

                $query->where('company_id', $request->company_id)
                    ->where('branch_id', $request->branch_id)
                    ->where('division_id', $request->division_id)
                    ->where('departement_id', $request->departement_id)
                    ->where('section_id', $request->section_id)
                    ->where('line_id', $request->line_id);
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = WorkingHoursChart::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->whereHas('workingHoursType', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            });
                    });
                }

                $query->where('company_id', $request->company_id)
                    ->where('branch_id', $request->branch_id)
                    ->where('division_id', $request->division_id)
                    ->where('departement_id', $request->departement_id)
                    ->where('section_id', $request->section_id)
                    ->where('line_id', $request->line_id);
            })
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            $nomor = $start + 1;

            foreach($query_data as $val) {
                if($val->hasRelation()) {
                    $destroy = '<a href="javascript:void(0);" class="dropdown-item disabled"><i class="icon-trash"></i> Delete</a>';
                } else {
                    $destroy = '<a href="javascript:void(0);" onclick="destroy(' . $val->id . ')" class="dropdown-item"><i class="icon-trash"></i> Delete</a>';
                }

                $response['data'][] = [
                    $nomor,
                    $val->workingHoursType->name,
                    $val->start_date ? $val->start_date : '-',
                    $val->end_date ? $val->end_date : '-',
                    $val->workingHoursType->workingHoursTypeDetail()->where('status', 1)->count() . ' Day',
                    $val->workingHoursType->workingHoursTypeDetail()->where('status', 2)->count() . ' Day',
                    $val->workingHoursType->totalHours()->working . ' Hours',
                    '
                        <div class="list-icons">
                            <div class="dropdown">
                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="javascript:void(0);" onclick="show(' . $val->id . ')" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                    ' . $destroy . '
                                </div>
                            </div>
                        </div>
                    '
                ];

                $nomor++;
            }
        }

        $response['recordsTotal'] = 0;
        if($total_data <> FALSE) {
            $response['recordsTotal'] = $total_data;
        }

        $response['recordsFiltered'] = 0;
        if($total_filtered <> FALSE) {
            $response['recordsFiltered'] = $total_filtered;
        }

        return response()->json($response);
    }

    public function getData(Request $request)
    {
        $company     = SisterCompany::find($request->company_id);
        $branch      = SisterBranch ::where('idsetupsisterbranch', $request->branch_id)->first();
        $division    = Division::find($request->division_id);
        $departement = Departement::find($request->departement_id);
        $section     = Section::find($request->section_id);
        $line        = Line::find($request->line_id);

        return response()->json([
            'company'     => $company ? $company->name : '-',
            'branch'      => $branch ? $branch->description : '-',
            'division'    => $division ? $division->divisi : '-',
            'departement' => $departement ? $departement->department : '-',
            'section'     => $section ? $section->name : '-',
            'line'        => $line ? $line->name : '-',
        ]);
    }

    public function getWhtDetail(Request $request)
    {
        $wht_detail         = [];
        $data               = WorkingHoursType::find($request->working_hours_type_id);
        $total_all          = $data ? $data->total_working_day : 0;
        $total_work         = $data ? $data->workingHoursTypeDetail()->where('status', 1)->count() : 0;
        $total_break        = $data ? $data->workingHoursTypeDetail()->where('status', 2)->count() : 0;
        $total_hours_worked = $data ? 24 * $total_work : 0;
        $start_date         = $request->start_date;

        if($data) {
            foreach($data->workingHoursTypeDetail as $key => $whtd) {
                if($whtd->status == 1) {
                    $total_work_hours = $whtd->differenceTime()->working[0] . ' Hours ' . $whtd->differenceTime()->working[1] . ' Minutes';
                } else {
                    $total_work_hours = '-';
                }

                if($start_date) {
                    $day = '(' . date('l', strtotime("+$key day")) . ')';
                } else {
                    $day = '';
                }

                $wht_detail[] = [
                    'class'            => $whtd->status == 1 ? '' : 'text-white bg-danger',
                    'day'              => $day,
                    'status'           => $whtd->status(),
                    'work_start_time'  => $whtd->work_start_time ? date('H:i', strtotime($whtd->work_start_time)) : '-',
                    'work_end_time'    => $whtd->work_end_time ? date('H:i', strtotime($whtd->work_end_time)) : '-',
                    'break_start_time' => $whtd->break_start_time ? date('H:i', strtotime($whtd->break_start_time)) : '-',
                    'break_end_time'   => $whtd->break_end_time ? date('H:i', strtotime($whtd->break_end_time)) : '-',
                    'total_work_hours' => $total_work_hours
                ];
            }
        }

        if($data) {
            if($start_date) {
                $end_date = date('d/m/Y', strtotime('+' . $data->total_working_day . ' Day', strtotime($start_date)));
            } else {
                $end_date = '-';
            }
        } else {
            $end_date = '-';
        }

        return response()->json([
            'end_date'            => $end_date,
            'total_day'           => $data->total_working_day . ' Day',
            'total_working_day'   => $data->workingHoursTypeDetail()->where('status', 1)->count() . ' Day',
            'total_holiday'       => $data->workingHoursTypeDetail()->where('status', 2)->count() . ' Day',
            'total_working_hours' => $data->totalHours()->working . ' Hours',
            'wht_detail'          => $wht_detail
        ]);
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'working_hours_type_id' => 'required'
        ], [
            'working_hours_type_id.required' => 'Please select a type working hours.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = WorkingHoursChart::create([
                'working_hours_type_id' => $request->working_hours_type_id,
                'company_id'            => $request->company_id,
                'branch_id'             => $request->branch_id,
                'division_id'           => $request->division_id,
                'departement_id'        => $request->departement_id,
                'section_id'            => $request->section_id,
                'line_id'               => $request->line_id
            ]);

            if($query) {
                activity('chart working hours')
                    ->performedOn(new WorkingHoursChart())
                    ->causedBy(session('id'))
                    ->log('create data');

                $response = [
                    'status'  => 200,
                    'message' => 'Data added successfully.'
                ];
            } else {
                $response = [
                    'status'  => 500,
                    'message' => 'Data failed to add.'
                ];
            }
        }

        return response()->json($response);
    }

    public function show(Request $request)
    {
        $data = WorkingHoursChart::find($request->id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'working_hours_type_id' => 'required',
            'start_date'            => 'required'
        ], [
            'working_hours_type_id.required' => 'Please select a type working hours.',
            'start_date.required'            => 'Start date cannot be empty.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $wht   = WorkingHoursType::find($request->working_hours_type_id);
            $query = WorkingHoursChart::find($id)->update([
                'working_hours_type_id' => $request->working_hours_type_id,
                'company_id'            => $request->company_id,
                'branch_id'             => $request->branch_id,
                'division_id'           => $request->division_id,
                'departement_id'        => $request->departement_id,
                'section_id'            => $request->section_id,
                'line_id'               => $request->line_id,
                'start_date'            => $request->start_date,
                'end_date'              => date('Y-m-d', strtotime('+' . $wht->total_working_day . ' day', strtotime($request->start_date)))
            ]);

            if($query) {
                activity('chart working hours')
                    ->performedOn(new WorkingHoursChart())
                    ->causedBy(session('id'))
                    ->log('edit data');

                $response = [
                    'status'  => 200,
                    'message' => 'Data updated successfully.'
                ];
            } else {
                $response = [
                    'status'  => 500,
                    'message' => 'Data failed to update.'
                ];
            }
        }

        return response()->json($response);
    }

    public function destroy(Request $request)
    {
        $query = WorkingHoursChart::destroy($request->id);
        if($query) {
            activity('chart working hours')
                ->performedOn(new WorkingHoursChart())
                ->causedBy(session('id'))
                ->log('delete data');

            $response = [
                'status'  => 200,
                'message' => 'Data deleted successfully.'
            ];
        } else {
            $response = [
                'status'  => 500,
                'message' => 'Data failed to delete.'
            ];
        }

        return response()->json($response);
    }

}
