<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Buyer;
use App\Models\Color;
use App\Models\Style;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\SalesOrderDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SalesOrderController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'Production Order - SO Production',
            'buyer'   => Buyer::where('status', 1)->get(),
            'style'   => Style::where('status', 1)->get(),
            'color'   => Color::where('status', 1)->get(),
            'city'    => City::orderBy('name', 'asc')->get(),
            'content' => 'production_order.so_production'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request)
    {
        $column = [
            'no',
            'id',
            'code',
            'buyer_id',
            'brand_id',
            'product_class_id',
            'style_code',
            'style_id',
            'city_id',
            'delivery_date',
            'price',
            'tax',
            'subtotal'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = SalesOrder::count();

        $query_data = SalesOrder::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('code', 'like', "%$search%")
                            ->orWhereHas('buyer', function($query) use ($search) {
                                $query->where('company', 'like', "%$search%");
                            })
                            ->orWhereHas('style', function($query) use ($search) {
                                $query->where('code', 'like', "%$search%")
                                    ->orWhere('name', 'like', "%$search%")
                                    ->orWhereHas('brand', function($query) use ($search) {
                                        $query->where('name', 'like', "%$search%");
                                    })
                                    ->orWhereHas('productType', function($query) use ($search) {
                                        $query->whereHas('productClass', function($query) use ($search) {
                                            $query->where('name', 'like', "%$search%");
                                        });
                                    });
                            })
                            ->orWhereHas('city', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            });
                    });
                }
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = SalesOrder::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('code', 'like', "%$search%")
                            ->orWhereHas('buyer', function($query) use ($search) {
                                $query->where('company', 'like', "%$search%");
                            })
                            ->orWhereHas('style', function($query) use ($search) {
                                $query->where('code', 'like', "%$search%")
                                    ->orWhere('name', 'like', "%$search%")
                                    ->orWhereHas('brand', function($query) use ($search) {
                                        $query->where('name', 'like', "%$search%");
                                    })
                                    ->orWhereHas('productType', function($query) use ($search) {
                                        $query->whereHas('productClass', function($query) use ($search) {
                                            $query->where('name', 'like', "%$search%");
                                        });
                                    });
                            })
                            ->orWhereHas('city', function($query) use ($search) {
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
                $price    = $val->price;
                $tax      = $val->tax;
                $subtotal = (($tax / 100) * $price) + $price;

                if($val->hasRelation()) {
                    $destroy = '<a href="javascript:void(0);" class="dropdown-item disabled"><i class="icon-trash"></i> Delete</a>';
                } else {
                    $destroy = '<a href="javascript:void(0);" onclick="destroy(' . $val->id . ')" class="dropdown-item"><i class="icon-trash"></i> Delete</a>';
                }

                $response['data'][] = [
                    $nomor,
                    $val->id,
                    $val->code,
                    $val->buyer->company,
                    $val->style->brand->name,
                    $val->style->productType->productClass->name,
                    $val->style->code,
                    $val->style->name,
                    $val->city->name,
                    $val->delivery_date,
                    number_format($price, 0, ',', '.'),
                    $tax . '%',
                    number_format($subtotal, 0, ',', '.'),
                    '
                        <div class="list-icons">
                            <div class="dropdown">
                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="javascript:void(0);" onclick="show(' . $val->id . ')" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                    ' . $destroy . '
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

    public function getSize(Request $request)
    {
        $data        = Style::find($request->id);
        $size_detail = [];

        if($data) {
            foreach($data->size->sizeDetail as $s) {
                $size_detail[] = [
                    'id'    => $s->id,
                    'value' => $s->value
                ];
            }
        }

        return response()->json($size_detail);
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'buyer_id'      => 'required',
            'style_id'      => 'required',
            'city_id'       => 'required',
            'code'          => 'required|unique:mysql.sales_orders,code',
            'price'         => 'required',
            'delivery_date' => 'required'
        ], [
            'buyer_id.required'      => 'Please select a buyer.',
            'style_id.required'      => 'Please select a style.',
            'city_id.required'       => 'Please select a destination.',
            'code.required'          => 'No SO cannot be empty.',
            'code.unique'            => 'No SO exists.',
            'price.required'         => 'Price cannot be empty.',
            'delivery_date.required' => 'Delivery date cannot be empty.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = SalesOrder::create([
                'buyer_id'      => $request->buyer_id,
                'style_id'      => $request->style_id,
                'city_id'       => $request->city_id,
                'code'          => $request->code,
                'price'         => $request->price,
                'tax'           => $request->tax,
                'delivery_date' => $request->delivery_date
            ]);

            if($query) {
                if($request->detail) {
                    foreach($request->detail as $key => $d) {
                        SalesOrderDetail::create([
                            'sales_order_id' => $query->id,
                            'color_id'       => $request->detail_color_id[$key],
                            'size_detail_id' => $request->detail_size_detail_id[$key],
                            'qty'            => $request->detail_qty[$key]
                        ]);
                    }
                }

                activity('so production')
                    ->performedOn(new SalesOrder())
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
        $detail = [];
        $data   = SalesOrder::find($request->id);

        if($data->salesOrderDetail) {
            foreach($data->salesOrderDetail as $sod) {
                $detail[] = [
                    'color_id'          => $sod->color_id,
                    'color_name'        => $sod->color->name,
                    'size_detail_id'    => $sod->size_detail_id,
                    'size_detail_value' => $sod->sizeDetail->value,
                    'qty'               => $sod->qty
                ];
            }
        }

        return response()->json([
            'buyer_id'      => $data->buyer_id,
            'style_id'      => $data->style_id,
            'city_id'       => $data->city_id,
            'code'          => $data->code,
            'price'         => $data->price,
            'tax'           => $data->tax,
            'delivery_date' => $data->delivery_date,
            'detail'        => $detail
        ]);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'buyer_id'      => 'required',
            'style_id'      => 'required',
            'city_id'       => 'required',
            'code'          => ['required', Rule::unique('mysql.sales_orders', 'code')->ignore($id)],
            'price'         => 'required',
            'delivery_date' => 'required'
        ], [
            'buyer_id.required'      => 'Please select a buyer.',
            'style_id.required'      => 'Please select a style.',
            'city_id.required'       => 'Please select a destination.',
            'code.required'          => 'No SO cannot be empty.',
            'code.unique'            => 'No SO exists.',
            'price.required'         => 'Price cannot be empty.',
            'delivery_date.required' => 'Delivery date cannot be empty.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = SalesOrder::find($id)->update([
                'buyer_id'      => $request->buyer_id,
                'style_id'      => $request->style_id,
                'city_id'       => $request->city_id,
                'code'          => $request->code,
                'price'         => $request->price,
                'tax'           => $request->tax,
                'delivery_date' => $request->delivery_date
            ]);

            if($query) {
                SalesOrderDetail::where('sales_order_id', $id)->delete();
                if($request->detail) {
                    foreach($request->detail as $key => $d) {
                        SalesOrderDetail::create([
                            'sales_order_id' => $id,
                            'color_id'       => $request->detail_color_id[$key],
                            'size_detail_id' => $request->detail_size_detail_id[$key],
                            'qty'            => $request->detail_qty[$key]
                        ]);
                    }
                }

                activity('so production')
                    ->performedOn(new SalesOrder())
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

    public function destroy(Request $request)
    {
        $query = SalesOrder::destroy($request->id);
        if($query) {
            activity('so production')
                ->performedOn(new SalesOrder())
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
