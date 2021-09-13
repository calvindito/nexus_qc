<?php

namespace App\Http\Controllers;

use App\Models\GroupDefect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CriticalDefectListController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'Group Defect - Critical Defect List',
            'parent'  => GroupDefect::where('status', 1)->where('type', 5)->get(),
            'content' => 'group_defect.critical_defect_list'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request)
    {
        $column = [
            'id',
            'parent_id',
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

        $total_data = GroupDefect::where('type', 6)
            ->count();

        $query_data = GroupDefect::where('type', 6)
            ->where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('code', 'like', "%$search%")
                            ->orWhere('name', 'like', "%$search%")
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

        $total_filtered = GroupDefect::where('type', 6)
            ->where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('code', 'like', "%$search%")
                            ->orWhere('name', 'like', "%$search%")
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
                $response['data'][] = [
                    $nomor,
                    $val->parent()->name,
                    $val->code,
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
                                    <a href="javascript:void(0);" class="dropdown-item" onclick="update(' . $val->id . ', 1)">Activate</a>
                                    <a href="javascript:void(0);" class="dropdown-item" onclick="update(' . $val->id . ', 2)">Deactivate</a>
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

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'code'      => 'required|unique:group_defects,code',
            'name'      => 'required',
            'parent_id' => 'required',
            'status'    => 'required'
        ], [
            'code.required'      => 'Code cannot be empty.',
            'code.unique'        => 'Code exists.',
            'name.required'      => 'Critical defect cannot be empty.',
            'parent_id.required' => 'Please select a major defect.',
            'status.required'    => 'Please select a status.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = GroupDefect::create([
                'created_by' => session('id'),
                'updated_by' => session('id'),
                'code'       => $request->code,
                'name'       => $request->name,
                'parent_id'  => $request->parent_id,
                'type'       => 6,
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

    public function update(Request $request)
    {
        $query = GroupDefect::find($request->id)->update([
            'updated_by' => session('id'),
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

        return response()->json($response);
    }

}
