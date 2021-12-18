<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkingHoursType;
use App\Http\Controllers\Controller;
use App\Models\WorkingHoursTypeDetail;
use Illuminate\Support\Facades\Validator;

class WorkingHoursTypeController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'Working Hours - Type',
            'content' => 'working_hours.type'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request)
    {
        $column = [
            'detail',
            'no',
            'name',
            'total_working_day',
            'total_holiday',
            'total_working_hours',
            'status',
            'updated_by',
            'created_at'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = WorkingHoursType::count();

        $query_data = WorkingHoursType::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('name', 'like', "%$search%")
                            ->orWhereHas('updatedBy', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            });
                    });
                }
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = WorkingHoursType::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('name', 'like', "%$search%")
                            ->orWhereHas('updatedBy', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            });
                    });
                }
            })
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            $nomor = $start + 1;

            foreach($query_data as $val) {
                if($val->status == 1) {
                    $status = '<a href="javascript:void(0);" onclick="changeStatus(' . $val->id . ', 2)" class="dropdown-item"><i class="icon-cross"></i> Inactive</a>';
                } else {
                    $status = '<a href="javascript:void(0);" onclick="changeStatus(' . $val->id . ', 1)" class="dropdown-item"><i class="icon-check"></i> Active</a>';
                }

                if($val->hasRelation()) {
                    $destroy = '<a href="javascript:void(0);" class="dropdown-item disabled"><i class="icon-trash"></i> Delete</a>';
                } else {
                    $destroy = '<a href="javascript:void(0);" onclick="destroy(' . $val->id . ')" class="dropdown-item"><i class="icon-trash"></i> Delete</a>';
                }

                $response['data'][] = [
                    '<a href="javascript:void(0);" onclick="detail(' . $val->id . ')" class="text-info"><i class="icon-info22"></i></a>',
                    $nomor,
                    $val->name,
                    $val->workingHoursTypeDetail()->where('status', 1)->count() . ' Day',
                    $val->workingHoursTypeDetail()->where('status', 2)->count() . ' Day',
                    $val->totalHours()->working . ' Hours',
                    $val->status(),
                    $val->updatedBy->name,
                    $val->created_at->format('d F Y'),
                    '
                        <div class="list-icons">
                            <div class="dropdown">
                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="' . url('working_hours/type/update/' . $val->id) . '" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                    ' . $destroy . '
                                    ' . $status . '
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

    public function detail(Request $request)
    {
        $wht_detail = [];
        $data       = WorkingHoursType::find($request->id);

        foreach($data->workingHoursTypeDetail as $key => $whtd) {
            if($whtd->status == 1) {
                $total_work_hours = $whtd->differenceTime()->working[0] . ' Hours ' . $whtd->differenceTime()->working[1] . ' Minutes';
            } else {
                $total_work_hours = '-';
            }

            $wht_detail[] = [
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
            'name'                => $data->name,
            'total_day'           => $data->total_working_day . ' Day',
            'total_working_day'   => $data->workingHoursTypeDetail()->where('status', 1)->count() . ' Day',
            'total_holiday'       => $data->workingHoursTypeDetail()->where('status', 2)->count() . ' Day',
            'total_working_hours' => $data->totalHours()->working . ' Hours',
            'late_tolerance'      => $data->late_tolerance ? $data->late_tolerance . ' Minutes' : 'Not Set',
            'created_at'          => $data->created_at->format('d F Y'),
            'created_by'          => $data->createdBy->name,
            'updated_by'          => $data->updatedBy->name,
            'status'              => $data->status(),
            'wht_detail'          => $wht_detail
        ]);
    }

    public function create(Request $request)
    {
        if($request->ajax()) {
            $validation = Validator::make($request->all(), [
                'wht_detail'        => 'required',
                'name'              => 'required',
                'total_working_day' => 'required',
                'status'            => 'required'
            ], [
                'wht_detail.required'        => 'Please fill in the working time list.',
                'name.required'              => 'Type working hours cannot be empty.',
                'total_working_day.required' => 'Total day cannot be empty.',
                'status.required'            => 'Please select a status.'
            ]);

            if($validation->fails()) {
                $response = [
                    'status' => 422,
                    'error'  => $validation->errors()
                ];
            } else {
                $query = WorkingHoursType::create([
                    'created_by'        => session('id'),
                    'updated_by'        => session('id'),
                    'name'              => $request->name,
                    'total_working_day' => $request->total_working_day,
                    'late_tolerance'    => $request->late_tolerance,
                    'status'            => $request->status
                ]);

                if($query) {
                    if($request->wht_detail) {
                        foreach($request->wht_detail as $key => $wd) {
                            $work_start_time  = $request->wht_work_start_time[$key] ? $request->wht_work_start_time[$key] . ':00' : null;
                            $work_end_time    = $request->wht_work_end_time[$key] ? $request->wht_work_end_time[$key] . ':00' : null;
                            $break_start_time = $request->wht_break_start_time[$key] ? $request->wht_break_start_time[$key] . ':00' : null;
                            $break_end_time   = $request->wht_break_end_time[$key] ? $request->wht_break_end_time[$key] . ':00' : null;

                            WorkingHoursTypeDetail::create([
                                'working_hours_type_id' => $query->id,
                                'work_start_time'       => $work_start_time,
                                'work_end_time'         => $work_end_time,
                                'break_start_time'      => $break_start_time,
                                'break_end_time'        => $break_end_time,
                                'status'                => $request->wht_status[$key]
                            ]);
                        }
                    }

                    activity('type working hours')
                        ->performedOn(new WorkingHoursType())
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
        } else {
            $data = [
                'title'   => 'Working Hours - Type - Create',
                'content' => 'working_hours.type_create'
            ];

            return view('layouts.index', ['data' => $data]);
        }
    }

    public function update(Request $request, $id)
    {
        if($request->ajax()) {
            $validation = Validator::make($request->all(), [
                'name'   => 'required',
                'status' => 'required'
            ], [
                'name.required'   => 'Type working hours cannot be empty.',
                'status.required' => 'Please select a status.'
            ]);

            if($validation->fails()) {
                $response = [
                    'status' => 422,
                    'error'  => $validation->errors()
                ];
            } else {
                $query = WorkingHoursType::find($id)->update([
                    'updated_by'     => session('id'),
                    'name'           => $request->name,
                    'late_tolerance' => $request->late_tolerance,
                    'status'         => $request->status
                ]);

                if($query) {
                    foreach($request->wht_detail as $key => $wd) {
                        $work_start_time  = $request->wht_work_start_time[$key] ? $request->wht_work_start_time[$key] . ':00' : null;
                        $work_end_time    = $request->wht_work_end_time[$key] ? $request->wht_work_end_time[$key] . ':00' : null;
                        $break_start_time = $request->wht_break_start_time[$key] ? $request->wht_break_start_time[$key] . ':00' : null;
                        $break_end_time   = $request->wht_break_end_time[$key] ? $request->wht_break_end_time[$key] . ':00' : null;

                        WorkingHoursTypeDetail::find($request->wht_id[$key])->update([
                            'work_start_time'  => $work_start_time,
                            'work_end_time'    => $work_end_time,
                            'break_start_time' => $break_start_time,
                            'break_end_time'   => $break_end_time,
                            'status'           => $request->wht_status[$key]
                        ]);
                    }

                    activity('type working hours')
                        ->performedOn(new WorkingHoursType())
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
        } else {
            $data = [
                'title'   => 'Working Hours - Type - Edit',
                'wht'     => WorkingHoursType::find($id),
                'content' => 'working_hours.type_update'
            ];

            return view('layouts.index', ['data' => $data]);
        }
    }

    public function changeStatus(Request $request)
    {
        $query = WorkingHoursType::find($request->id)->update(['status' => $request->status]);
        if($query) {
            activity('type working hours')
                ->performedOn(new WorkingHoursType())
                ->causedBy(session('id'))
                ->log('change status');

            $response = [
                'status'  => 200,
                'message' => 'Status has been changed.'
            ];
        } else {
            $response = [
                'status'  => 500,
                'message' => 'Failed to change status.'
            ];
        }

        return response()->json($response);
    }

    public function destroy(Request $request)
    {
        $query = WorkingHoursType::destroy($request->id);
        if($query) {
            activity('type working hours')
                ->performedOn(new WorkingHoursType())
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
