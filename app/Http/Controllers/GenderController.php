<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GenderController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'Master Data - General - Gender',
            'content' => 'master_data.general.gender'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request)
    {
        $column = [
            'id',
            'code',
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

        $total_data = Gender::count();

        $query_data = Gender::where(function($query) use ($search, $request) {
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

        $total_filtered = Gender::where(function($query) use ($search, $request) {
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
            foreach($query_data as $val) {
                $response['data'][] = [
                    $val->id,
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
                                    <a href="javascript:void(0);" onclick="show(' . $val->id . ')" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
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

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'   => 'required',
            'status' => 'required'
        ], [
            'name.required'   => 'Gender cannot be empty.',
            'status.required' => 'Please select a status.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = Gender::create([
                'created_by' => session('id'),
                'updated_by' => session('id'),
                'name'       => $request->name,
                'status'     => $request->status
            ]);

            if($query) {
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
        $data = Gender::find($request->id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name'   => 'required',
            'status' => 'required'
        ], [
            'name.required'   => 'Gender cannot be empty.',
            'status.required' => 'Please select a status.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = Gender::find($id)->update([
                'updated_by' => session('id'),
                'name'       => $request->name,
                'status'     => $request->status
            ]);

            if($query) {
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

    public function changeStatus(Request $request)
    {
        $query = Gender::find($request->id)->update(['status' => $request->status]);
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
