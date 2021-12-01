<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Style;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StyleController extends Controller {

    public function index()
    {
        $data = [
            'title'        => 'Product - Style',
            'type_product' => ProductType::where('status', 1)->get(),
            'brand'        => Brand::where('status', 1)->get(),
            'size'         => Size::where('status', 1)->get(),
            'content'      => 'product.style'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request)
    {
        $column = [
            'no',
            'id',
            'brand_id',
            'class_product_id',
            'product_type_id',
            'size_id',
            'code',
            'name',
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

        $total_data = Style::count();

        $query_data = Style::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('code', 'like', "%$search%")
                            ->orWhere('name', 'like', "%$search%")
                            ->orWhereHas('brand', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhereHas('productType', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%")
                                    ->orWhereHas('productClass', function($query) use ($search) {
                                        $query->where('name', 'like', "%$search%");
                                    });
                            })
                            ->orWhereHas('size', function($query) use ($search) {
                                $query->where('group', 'like', "%$search%");
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

        $total_filtered = Style::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('code', 'like', "%$search%")
                            ->orWhere('name', 'like', "%$search%")
                            ->orWhereHas('brand', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhereHas('productType', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%")
                                    ->orWhereHas('productClass', function($query) use ($search) {
                                        $query->where('name', 'like', "%$search%");
                                    });
                            })
                            ->orWhereHas('size', function($query) use ($search) {
                                $query->where('group', 'like', "%$search%");
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
                $size = '';
                foreach($val->size->sizeDetail as $key => $sd) {
                    $delimeter = $key + 1 == $val->size->sizeDetail->count() ? '' : ', ';
                    $size     .= $sd->value . $delimeter;
                }

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
                    $val->brand->name,
                    $val->productType->productClass->name,
                    $val->productType->name,
                    '<a href="javascript:void(0);" class="text-dark" data-popup="tooltip" title="' . $size . '">' . $val->size->group . '</a>',
                    $val->code,
                    $val->name,
                    $val->productType->smv_global,
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

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'product_type_id' => 'required',
            'brand_id'        => 'required',
            'size_id'         => 'required',
            'code'            => 'required|unique:mysql.styles,code',
            'name'            => 'required',
            'status'          => 'required'
        ], [
            'product_type_id.required' => 'Please select a type product.',
            'brand_id.required'        => 'Please select a brand.',
            'size_id.required'         => 'Please select a size.',
            'code.required'            => 'Code cannot be empty.',
            'code.unique'              => 'Code exists.',
            'name.required'            => 'Style cannot be empty.',
            'status.required'          => 'Please select a status.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = Style::create([
                'product_type_id' => $request->product_type_id,
                'brand_id'        => $request->brand_id,
                'size_id'         => $request->size_id,
                'created_by'      => session('id'),
                'updated_by'      => session('id'),
                'code'            => $request->code,
                'name'            => $request->name,
                'status'          => $request->status
            ]);

            if($query) {
                activity('style')
                    ->performedOn(new Style())
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
        $data = Style::find($request->id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'product_type_id' => 'required',
            'brand_id'        => 'required',
            'size_id'         => 'required',
            'code'            => ['required', Rule::unique('mysql.styles', 'code')->ignore($id)],
            'name'            => 'required',
            'status'          => 'required'
        ], [
            'product_type_id.required' => 'Please select a type product.',
            'brand_id.required'        => 'Please select a brand.',
            'size_id.required'         => 'Please select a size.',
            'code.required'            => 'Code cannot be empty.',
            'code.unique'              => 'Code exists.',
            'name.required'            => 'Style cannot be empty.',
            'status.required'          => 'Please select a status.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = Style::find($id)->update([
                'product_type_id' => $request->product_type_id,
                'brand_id'        => $request->brand_id,
                'size_id'         => $request->size_id,
                'updated_by'      => session('id'),
                'code'            => $request->code,
                'name'            => $request->name,
                'status'          => $request->status
            ]);

            if($query) {
                activity('style')
                    ->performedOn(new Style())
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
        $query = Style::find($request->id)->update(['status' => $request->status]);
        if($query) {
            activity('style')
                ->performedOn(new Style())
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
        $query = Style::destroy($request->id);
        if($query) {
            activity('style')
                ->performedOn(new Style())
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
