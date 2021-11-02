<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\SizeDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GroupSizeController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'General - Group Size',
            'content' => 'general.group_size'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request)
    {
        $column = [
            'id',
            'group',
            'value',
            'status',
            'updated_by',
            'created_at'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Size::count();

        $query_data = Size::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('group', 'like', "%$search%")
                            ->whereHas('updatedBy', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhereHas('sizeDetail', function($query) use ($search) {
                                $query->where('value', 'like', "%$search%");
                            });
                    });
                }
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = Size::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('group', 'like', "%$search%")
                            ->whereHas('updatedBy', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhereHas('sizeDetail', function($query) use ($search) {
                                $query->where('value', 'like', "%$search%");
                            });
                    });
                }
            })
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            foreach($query_data as $val) {
                $value = '';
                if($val->sizeDetail) {
                    foreach($val->sizeDetail as $sd) {
                        $value .= '<span class="badge badge-flat border-secondary text-secondary mb-2 mr-2">' . $sd->value . '</span>';
                    }
                } else {
                    $value .= 'Value not selected';
                }

                if($val->status == 1) {
                    $status = '<a href="javascript:void(0);" onclick="changeStatus(' . $val->id . ', 2)" class="dropdown-item"><i class="icon-cross"></i> Inactive</a>';
                } else {
                    $status = '<a href="javascript:void(0);" onclick="changeStatus(' . $val->id . ', 1)" class="dropdown-item"><i class="icon-check"></i> Active</a>';
                }

                if($val->relations) {
                    $destroy = '<a href="javascript:void(0);" class="dropdown-item disabled"><i class="icon-trash"></i> Delete</a>';
                } else {
                    $destroy = '<a href="javascript:void(0);" onclick="destroy(' . $val->id . ')" class="dropdown-item"><i class="icon-trash"></i> Delete</a>';
                }

                $response['data'][] = [
                    $val->id,
                    $val->group,
                    $value,
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
                                    ' . $destroy . '
                                    ' . $status . '
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
            'group'  => 'required',
            'value'  => 'required',
            'status' => 'required'
        ], [
            'group.required'  => 'Group cannot be empty.',
            'value.required'  => 'Size chart cannot be empty.',
            'status.required' => 'Please select a status.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = Size::create([
                'created_by' => session('id'),
                'updated_by' => session('id'),
                'group'      => $request->group,
                'status'     => $request->status
            ]);

            if($query) {
                if($request->value) {
                    foreach($request->value as $v) {
                        SizeDetail::create([
                            'size_id' => $query->id,
                            'value'   => $v
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
    }

    public function show(Request $request)
    {
        $data = Size::find($request->id);
        return response()->json([
            'group'       => $data->group,
            'status'      => $data->status,
            'size_detail' => $data->sizeDetail
        ]);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'group'  => 'required',
            'value'  => 'required',
            'status' => 'required'
        ], [
            'group.required'  => 'Group cannot be empty.',
            'value.required'  => 'Size chart cannot be empty.',
            'status.required' => 'Please select a status.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = Size::find($id)->update([
                'updated_by' => session('id'),
                'group'      => $request->group,
                'status'     => $request->status
            ]);

            if($query) {
                SizeDetail::where('size_id', $id)->delete();
                if($request->value) {
                    foreach($request->value as $v) {
                        SizeDetail::create([
                            'size_id' => $id,
                            'value'   => $v
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
    }

    public function changeStatus(Request $request)
    {
        $query = Size::find($request->id)->update(['status' => $request->status]);
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

    public function destroy(Request $request)
    {
        $query = Size::destroy($request->id);
        if($query) {
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
