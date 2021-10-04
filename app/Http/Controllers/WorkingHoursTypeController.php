<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;
use App\Models\WorkingHoursType;
use App\Http\Controllers\Controller;
use App\Models\WorkingHoursTypeDetail;
use Illuminate\Support\Facades\Validator;

class WorkingHoursTypeController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'Master Data - Working Hours - Type',
            'content' => 'master_data.working_hours.type'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request)
    {
        $column = [
            'deteail',
            'id',
            'departement_id',
            'name',
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
                            ->orWhereHas('departement', function($query) use ($search) {
                                $query->where('department', 'like', "%$search%");
                            })
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
                            ->orWhereHas('departement', function($query) use ($search) {
                                $query->where('department', 'like', "%$search%");
                            })
                            ->orWhereHas('updatedBy', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            });
                    });
                }
            })
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            foreach($query_data as $val) {
                $response['data'][] = [
                    '<a href="javascript:void(0);" onclick="detail(' . $val->id . ')" class="text-info"><i class="icon-info22"></i></a>',
                    $val->id,
                    $val->departement->department,
                    $val->name,
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
                                    <a href="' . url('master_data/working_hours/type/update/' . $val->id) . '" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                    <a href="javascript:void(0);" onclick="changeStatus(' . $val->id . ', 1)" class="dropdown-item"><i class="icon-check"></i> Active</a>
                                    <a href="javascript:void(0);" onclick="changeStatus(' . $val->id . ', 2)" class="dropdown-item"><i class="icon-cross"></i> Inactive</a>
                                </div>
                            </div>
                        </div>
                    '
                ];
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

        if($data->WorkingHoursTypeDetail) {
            foreach($data->WorkingHoursTypeDetail as $whtd) {
                $wht_detail[] = [
                    'start_time'     => date('H:i', strtotime($whtd->start_time)),
                    'end_time'       => date('H:i', strtotime($whtd->end_time)),
                    'shift'          => $whtd->shift(),
                    'duration'       => $whtd->duration,
                    'order_sequence' => $whtd->order_sequence,
                    'total_minutes'  => $whtd->total_minutes
                ];
            }
        }

        return response()->json([
            'departement' => $data->departement->department,
            'name'        => $data->name,
            'created_by'  => $data->createdBy->name,
            'updated_by'  => $data->updatedBy->name,
            'created_at'  => $data->created_at->format('d F Y'),
            'status'      => $data->status(),
            'wht_detail'  => $wht_detail
        ]);
    }

    public function create(Request $request)
    {
        if($request->ajax()) {
            $validation = Validator::make($request->all(), [
                'wht_detail'     => 'required',
                'departement_id' => 'required',
                'name'           => 'required',
                'status'         => 'required'
            ], [
                'wht_detail.required'     => 'Please fill in the working time list.',
                'departement_id.required' => 'Please select a departement.',
                'name.required'           => 'Type working hours cannot be empty.',
                'status.required'         => 'Please select a status.'
            ]);

            if($validation->fails()) {
                $response = [
                    'status' => 422,
                    'error'  => $validation->errors()
                ];
            } else {
                $query = WorkingHoursType::create([
                    'departement_id' => $request->departement_id,
                    'created_by'     => session('id'),
                    'updated_by'     => session('id'),
                    'name'           => $request->name,
                    'status'         => $request->status
                ]);

                if($query) {
                    if($request->wht_detail) {
                        foreach($request->wht_detail as $key => $wd) {
                            WorkingHoursTypeDetail::create([
                                'working_hours_type_id' => $query->id,
                                'start_time'            => $request->wht_start_time[$key] . ':00',
                                'end_time'              => $request->wht_end_time[$key] . ':00',
                                'shift'                 => $request->wht_shift[$key],
                                'duration'              => $request->wht_duration[$key],
                                'order_sequence'        => $request->wht_order_sequence[$key],
                                'total_minutes'         => $request->wht_total_minutes[$key]
                            ]);
                        }
                    }

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
                'title'       => 'Master Data - Working Hours - Type - Create',
                'departement' => Departement::where('status', 'Active')->get(),
                'content'     => 'master_data.working_hours.type_create'
            ];

            return view('layouts.index', ['data' => $data]);
        }
    }

    public function update(Request $request, $id)
    {
        if($request->ajax()) {
            $validation = Validator::make($request->all(), [
                'wht_detail'     => 'required',
                'departement_id' => 'required',
                'name'           => 'required',
                'status'         => 'required'
            ], [
                'wht_detail.required'     => 'Please fill in the working time list.',
                'departement_id.required' => 'Please select a departement.',
                'name.required'           => 'Type working hours cannot be empty.',
                'status.required'         => 'Please select a status.'
            ]);

            if($validation->fails()) {
                $response = [
                    'status' => 422,
                    'error'  => $validation->errors()
                ];
            } else {
                $query = WorkingHoursType::find($id)->update([
                    'departement_id' => $request->departement_id,
                    'updated_by'     => session('id'),
                    'name'           => $request->name,
                    'status'         => $request->status
                ]);

                if($query) {
                    WorkingHoursTypeDetail::where('working_hours_type_id', $id)->delete();
                    if($request->wht_detail) {
                        foreach($request->wht_detail as $key => $wd) {
                            WorkingHoursTypeDetail::create([
                                'working_hours_type_id' => $id,
                                'start_time'            => $request->wht_start_time[$key] . ':00',
                                'end_time'              => $request->wht_end_time[$key] . ':00',
                                'shift'                 => $request->wht_shift[$key],
                                'duration'              => $request->wht_duration[$key],
                                'order_sequence'        => $request->wht_order_sequence[$key],
                                'total_minutes'         => $request->wht_total_minutes[$key]
                            ]);
                        }
                    }

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
                'title'       => 'Master Data - Working Hours - Type - Edit',
                'departement' => Departement::where('status', 'Active')->get(),
                'wht'         => WorkingHoursType::find($id),
                'content'     => 'master_data.working_hours.type_update'
            ];

            return view('layouts.index', ['data' => $data]);
        }
    }

    public function changeStatus(Request $request)
    {
        $query = WorkingHoursType::find($request->id)->update(['status' => $request->status]);
        if($query) {
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

}
