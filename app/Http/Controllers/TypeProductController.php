<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\ProductType;
use App\Models\ProductClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TypeProductController extends Controller {

    public function index()
    {
        $data = [
            'title'         => 'Master Data - General - Type Product',
            'class_product' => ProductClass::where('status', 1)->get(),
            'size'          => Size::where('status', 1)->get(),
            'content'       => 'master_data.general.type_product'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request)
    {
        $column = [
            'id',
            'product_class_id',
            'gender',
            'name',
            'description',
            'size_id',
            'smv_global',
            'status',
            'updated_by',
            'created_at'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = ProductType::count();

        $query_data = ProductType::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('name', 'like', "%$search%")
                            ->orWhere('description', 'like', "%$search%")
                            ->orWhere('smv_global', 'like', "%$search%")
                            ->orWhereHas('productClass', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%")
                                    ->orWhereHas('productClassDetail', function($query) use ($search) {
                                        $query->whereHas('gender', function($query) use ($search) {
                                            $query->where('name', 'like', "%$search%");
                                        });
                                    });
                            })
                            ->orWhereHas('size', function($query) use ($search) {
                                $query->whereHas('sizeDetail', function($query) use ($search) {
                                        $query->where('value', 'like', "%$search%");
                                    });
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

        $total_filtered = ProductType::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('name', 'like', "%$search%")
                            ->orWhere('description', 'like', "%$search%")
                            ->orWhere('smv_global', 'like', "%$search%")
                            ->orWhereHas('productClass', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%")
                                    ->orWhereHas('productClassDetail', function($query) use ($search) {
                                        $query->whereHas('gender', function($query) use ($search) {
                                            $query->where('name', 'like', "%$search%");
                                        });
                                    });
                            })
                            ->orWhereHas('size', function($query) use ($search) {
                                $query->whereHas('sizeDetail', function($query) use ($search) {
                                        $query->where('value', 'like', "%$search%");
                                    });
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
            $nomor = $start + 1;
            foreach($query_data as $val) {
                $gender = '';
                if($val->productClass->productClassDetail) {
                    foreach($val->productClass->productClassDetail as $pcd) {
                        $gender .= '<span class="badge badge-flat border-secondary text-secondary mb-2 mr-2">' . $pcd->gender->name . '</span>';
                    }
                } else {
                    $gender .= 'Gender not selected';
                }

                $value = '';
                if($val->size->sizeDetail) {
                    foreach($val->size->sizeDetail as $sd) {
                        $value .= '<span class="badge badge-flat border-secondary text-secondary mb-2 mr-2">' . $sd->value . '</span>';
                    }
                } else {
                    $value .= 'Value not selected';
                }

                $response['data'][] = [
                    $nomor,
                    $val->productClass->name,
                    $gender,
                    $val->name,
                    $val->description,
                    $value,
                    $val->smv_global,
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
            'product_class_id' => 'required',
            'size_id'          => 'required',
            'name'             => 'required',
            'smv_global'       => 'required',
            'status'           => 'required'
        ], [
            'product_class_id.required' => 'Please select a class product.',
            'size_id.required'          => 'Please select a group size.',
            'name.required'             => 'Type product cannot be empty.',
            'smv_global.required'       => 'Smv global cannot be empty.',
            'status.required'           => 'Please select a status.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = ProductType::create([
                'product_class_id' => $request->product_class_id,
                'size_id'          => $request->size_id,
                'created_by'       => session('id'),
                'updated_by'       => session('id'),
                'name'             => $request->name,
                'smv_global'       => $request->smv_global,
                'description'      => $request->description,
                'status'           => $request->status
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
        $data = ProductType::find($request->id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'product_class_id' => 'required',
            'size_id'          => 'required',
            'name'             => 'required',
            'smv_global'       => 'required',
            'status'           => 'required'
        ], [
            'product_class_id.required' => 'Please select a class product.',
            'size_id.required'          => 'Please select a group size.',
            'name.required'             => 'Type product cannot be empty.',
            'smv_global.required'       => 'Smv global cannot be empty.',
            'status.required'           => 'Please select a status.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = ProductType::find($id)->update([
                'product_class_id' => $request->product_class_id,
                'size_id'          => $request->size_id,
                'updated_by'       => session('id'),
                'name'             => $request->name,
                'smv_global'       => $request->smv_global,
                'description'      => $request->description,
                'status'           => $request->status
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
        $query = ProductType::find($request->id)->update(['status' => $request->status]);
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
