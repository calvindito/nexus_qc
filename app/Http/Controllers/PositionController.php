<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Imports\PositionImport;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'Group Defect - Position',
            'content' => 'group_defect.position'
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

        $total_data = Position::count();

        $query_data = Position::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('code', 'like', "%$search%")
                            ->orWhere('name', 'like', "%$search%");
                    });
                }
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = Position::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('code', 'like', "%$search%")
                            ->orWhere('name', 'like', "%$search%");
                    });
                }
            })
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
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
                    $val->id,
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

    public function bulk(Request $request)
    {
        if($request->has('_token') && $request->_token == csrf_token()) {
            $validation = Validator::make($request->all(), [
                'file_excel' => 'required|max:5120|mimes:xlsx'
            ], [
                'file_excel.required' => 'File excel cannot be empty.',
                'file_excel.max'      => 'File excel max size 5MB.',
                'file_excel.mimes'    => 'Only files with xlsx extension are allowed.'
            ]);

            if($validation->fails()) {
                return redirect()->back()->withErrors($validation);
            } else {
                $import = Excel::import(new PositionImport, $request->file('file_excel'));
                if($import) {
                    activity('position')
                        ->performedOn(new Position())
                        ->causedBy(session('id'))
                        ->log('do bulk upload');

                    return redirect()->back()->with(['success' => true]);
                } else {
                    return redirect()->back()->with(['failed' => true]);
                }
            }
        } else {
            $data = [
                'title'   => 'Group Defect - Position - Bulk Upload',
                'content' => 'group_defect.position_bulk'
            ];

            return view('layouts.index', ['data' => $data]);
        }
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required'
        ], [
            'name.required' => 'Position cannot be empty.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = Position::create([
                'created_by' => session('id'),
                'updated_by' => session('id'),
                'code'       => Position::generateCode(),
                'name'       => $request->name,
                'status'     => $request->status
            ]);

            if($query) {
                activity('position')
                    ->performedOn(new Position())
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
        $data = Position::find($request->id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required'
        ], [
            'name.required' => 'Position cannot be empty.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = Position::find($id)->update([
                'updated_by' => session('id'),
                'code'       => $request->code,
                'name'       => $request->name,
                'status'     => $request->status
            ]);

            if($query) {
                activity('position')
                    ->performedOn(new Position())
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

    public function changeStatus(Request $request)
    {
        $query = Position::find($request->id)->update(['status' => $request->status]);
        if($query) {
            activity('position')
                ->performedOn(new Position())
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
        $query = Position::destroy($request->id);
        if($query) {
            activity('position')
                ->performedOn(new Position())
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
