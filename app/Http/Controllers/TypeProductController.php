<?php

namespace App\Http\Controllers;

use Excel;
use App\Models\ProductType;
use App\Models\ProductClass;
use App\Models\ProductGroup;
use Illuminate\Http\Request;
use App\Imports\TypeProductImport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TypeProductController extends Controller {

    public function index()
    {
        $data = [
            'title'         => 'Product - Type',
            'class_product' => ProductClass::where('status', 1)->get(),
            'group'         => ProductGroup::where('status', 1)->get(),
            'content'       => 'product.type'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request)
    {
        $column = [
            'no',
            'id',
            'product_class_id',
            'product_group_id',
            'name',
            'description',
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
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhereHas('productGroup', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
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
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhereHas('productGroup', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
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
                    $nomor,
                    $val->id,
                    $val->productClass->name,
                    $val->productGroup->name,
                    $val->name,
                    $val->description,
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
                $import = Excel::import(new TypeProductImport, $request->file('file_excel'));
                if($import) {
                    activity('type product')
                        ->performedOn(new ProductType())
                        ->causedBy(session('id'))
                        ->log('do bulk upload');

                    return redirect()->back()->with(['success' => true]);
                } else {
                    return redirect()->back()->with(['failed' => true]);
                }
            }
        } else {
            $data = [
                'title'   => 'Product - Type - Bulk Upload',
                'content' => 'product.type_bulk'
            ];

            return view('layouts.index', ['data' => $data]);
        }
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'product_class_id' => 'required',
            'product_group_id' => 'required',
            'name'             => 'required',
            'smv_global'       => 'required',
            'status'           => 'required'
        ], [
            'product_class_id.required' => 'Please select a class product.',
            'product_group_id.required' => 'Please select a group.',
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
                'product_group_id' => $request->product_group_id,
                'created_by'       => session('id'),
                'updated_by'       => session('id'),
                'name'             => $request->name,
                'smv_global'       => $request->smv_global,
                'description'      => $request->description,
                'status'           => $request->status
            ]);

            if($query) {
                activity('type product')
                    ->performedOn(new ProductType())
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
        $data = ProductType::find($request->id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'product_class_id' => 'required',
            'product_group_id' => 'required',
            'name'             => 'required',
            'smv_global'       => 'required',
            'status'           => 'required'
        ], [
            'product_class_id.required' => 'Please select a class product.',
            'product_group_id.required' => 'Please select a group.',
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
                'product_group_id' => $request->product_group_id,
                'updated_by'       => session('id'),
                'name'             => $request->name,
                'smv_global'       => $request->smv_global,
                'description'      => $request->description,
                'status'           => $request->status
            ]);

            if($query) {
                activity('type product')
                    ->performedOn(new ProductType())
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
        $query = ProductType::find($request->id)->update(['status' => $request->status]);
        if($query) {
            activity('type product')
                ->performedOn(new ProductType())
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
        $query = ProductType::destroy($request->id);
        if($query) {
            activity('type product')
                ->performedOn(new ProductType())
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
