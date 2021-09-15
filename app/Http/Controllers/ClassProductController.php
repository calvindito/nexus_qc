<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Models\ProductClass;
use Illuminate\Http\Request;
use App\Models\ProductClassDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ClassProductController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'Master Data - General - Class Product',
            'gender'  => Gender::where('status', 1)->get(),
            'content' => 'master_data.general.class_product'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request)
    {
        $column = [
            'id',
            'name',
            'gender',
            'status',
            'updated_by',
            'created_at'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = ProductClass::count();

        $query_data = ProductClass::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('name', 'like', "%$search%")
                            ->orWhereHas('updatedBy', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhereHas('productClassDetail', function($query) use ($search) {
                                $query->whereHas('gender', function($query) use ($search) {
                                    $query->where('name', 'like', "%$search%");
                                });
                            });
                    });
                }
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = ProductClass::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('name', 'like', "%$search%")
                            ->orWhereHas('updatedBy', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhereHas('productClassDetail', function($query) use ($search) {
                                $query->whereHas('gender', function($query) use ($search) {
                                    $query->where('name', 'like', "%$search%");
                                });
                            });
                    });
                }
            })
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            $nomor = $start + 1;
            foreach($query_data as $val) {
                $gender = '';
                if($val->productClassDetail) {
                    foreach($val->productClassDetail as $pcd) {
                        $gender .= '<span class="badge badge-flat border-secondary text-secondary mb-2 mr-2">' . $pcd->gender->name . '</span>';
                    }
                } else {
                    $gender .= 'Gender not selected';
                }

                $response['data'][] = [
                    $nomor,
                    $val->name,
                    $gender,
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
                                    <a href="javascript:void(0);" onclick="changeStatus(' . $val->id . ', 1)" class="dropdown-item"><i class="icon-check"></i> Activate</a>
                                    <a href="javascript:void(0);" onclick="changeStatus(' . $val->id . ', 2)" class="dropdown-item"><i class="icon-cross"></i> Deactivate</a>
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
            'name'   => 'required',
            'gender' => 'required',
            'status' => 'required'
        ], [
            'name.required'   => 'Class product cannot be empty.',
            'gender.required' => 'Please select a gender.',
            'status.required' => 'Please select a status.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = ProductClass::create([
                'created_by' => session('id'),
                'updated_by' => session('id'),
                'name'       => $request->name,
                'status'     => $request->status
            ]);

            if($query) {
                if($request->gender) {
                    foreach($request->gender as $g) {
                        ProductClassDetail::create([
                            'product_class_id' => $query->id,
                            'gender_id'        => $g
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
        $data = ProductClass::find($request->id);
        return response()->json([
            'name'   => $data->name,
            'status' => $data->status,
            'gender' => $data->productClassDetail
        ]);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name'   => 'required',
            'gender' => 'required',
            'status' => 'required'
        ], [
            'name.required'   => 'Class product cannot be empty.',
            'gender.required' => 'Please select a gender.',
            'status.required' => 'Please select a status.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = ProductClass::find($id)->update([
                'updated_by' => session('id'),
                'name'       => $request->name,
                'status'     => $request->status
            ]);

            if($query) {
                ProductClassDetail::where('product_class_id', $id)->delete();
                if($request->gender) {
                    foreach($request->gender as $g) {
                        ProductClassDetail::create([
                            'product_class_id' => $id,
                            'gender_id'        => $g
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
        $query = ProductClass::find($request->id)->update(['status' => $request->status]);
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
