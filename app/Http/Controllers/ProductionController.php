<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Buyer;
use App\Models\Color;
use App\Models\Style;
use App\Models\Production;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\ProductionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductionController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'Order - Production',
            'buyer'   => Buyer::where('status', 1)->get(),
            'style'   => Style::where('status', 1)->get(),
            'color'   => Color::where('status', 1)->get(),
            'city'    => City::orderBy('name', 'asc')->get(),
            'content' => 'order.production'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request)
    {
        $column = [
            'no',
            'id',
            'code_production',
            'code_job_order',
            'code_buyer',
            'buyer_id',
            'brand_id',
            'destination_id',
            'delivery_date'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Production::count();

        $query_data = Production::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('code_production', 'like', "%$search%")
                            ->orWhere('code_job_order', 'like', "%$search%")
                            ->orWhere('code_buyer', 'like', "%$search%")
                            ->orWhereHas('buyer', function($query) use ($search) {
                                $query->where('company', 'like', "%$search%");
                            })
                            ->orWhereHas('style', function($query) use ($search) {
                                $query->whereHas('brand', function($query) use ($search) {
                                        $query->where('name', 'like', "%$search%");
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

        $total_filtered = Production::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('code_production', 'like', "%$search%")
                            ->orWhere('code_job_order', 'like', "%$search%")
                            ->orWhere('code_buyer', 'like', "%$search%")
                            ->orWhereHas('buyer', function($query) use ($search) {
                                $query->where('company', 'like', "%$search%");
                            })
                            ->orWhereHas('style', function($query) use ($search) {
                                $query->whereHas('brand', function($query) use ($search) {
                                        $query->where('name', 'like', "%$search%");
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
                if($val->hasRelation()) {
                    $destroy = '<a href="javascript:void(0);" class="dropdown-item disabled"><i class="icon-trash"></i> Delete</a>';
                } else {
                    $destroy = '<a href="javascript:void(0);" onclick="destroy(' . $val->id . ')" class="dropdown-item"><i class="icon-trash"></i> Delete</a>';
                }

                $response['data'][] = [
                    $nomor,
                    sprintf('%04s', $val->id),
                    $val->code_production,
                    $val->code_job_order,
                    $val->code_buyer,
                    $val->buyer->company,
                    $val->style->brand->name,
                    $val->city->name,
                    $val->delivery_date,
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
            'buyer_id'       => 'required',
            'style_id'       => 'required',
            'city_id'        => 'required',
            'code_job_order' => 'required|unique:mysql.productions,code_job_order',
            'code_buyer'     => 'required|unique:mysql.productions,code_buyer',
            'delivery_date'  => 'required'
        ], [
            'buyer_id.required'       => 'Please select a buyer.',
            'style_id.required'       => 'Please select a style.',
            'city_id.required'        => 'Please select a destination.',
            'code_job_order.required' => 'No job order cannot be empty.',
            'code_job_order.unique'   => 'No job order exists.',
            'code_buyer.required'     => 'No buyer cannot be empty.',
            'code_buyer.unique'       => 'No buyer exists.',
            'delivery_date.required'  => 'Delivery date cannot be empty.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = Production::create([
                'buyer_id'        => $request->buyer_id,
                'style_id'        => $request->style_id,
                'city_id'         => $request->city_id,
                'code_production' => Production::generateCodeProduction($request),
                'code_job_order'  => $request->code_job_order,
                'code_buyer'      => $request->code_buyer,
                'delivery_date'   => $request->delivery_date
            ]);

            if($query) {
                if($request->detail) {
                    foreach($request->detail as $key => $d) {
                        ProductionDetail::create([
                            'production_id'  => $query->id,
                            'color_id'       => $request->detail_color_id[$key],
                            'size_detail_id' => $request->detail_size_detail_id[$key],
                            'qty'            => $request->detail_qty[$key]
                        ]);
                    }
                }

                activity('production')
                    ->performedOn(new Production())
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
        $data   = Production::find($request->id);

        if($data->productionDetail) {
            foreach($data->productionDetail as $sod) {
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
            'buyer_id'        => $data->buyer_id,
            'style_id'        => $data->style_id,
            'city_id'         => $data->city_id,
            'code_production' => $data->code_production,
            'code_job_order'  => $data->code_job_order,
            'code_buyer'      => $data->code_buyer,
            'delivery_date'   => $data->delivery_date,
            'detail'          => $detail
        ]);
    }

    public function update(Request $request, $id)
    {
        $production = Production::find($id);
        $validation = Validator::make($request->all(), [
            'buyer_id'       => 'required',
            'style_id'       => 'required',
            'city_id'        => 'required',
            'code_job_order' => ['required', Rule::unique('mysql.productions', 'code_job_order')->ignore($id)],
            'code_buyer'     => ['required', Rule::unique('mysql.productions', 'code_buyer')->ignore($id)],
            'delivery_date'  => 'required'
        ], [
            'buyer_id.required'       => 'Please select a buyer.',
            'style_id.required'       => 'Please select a style.',
            'city_id.required'        => 'Please select a destination.',
            'code_job_order.required' => 'No job order cannot be empty.',
            'code_job_order.unique'   => 'No job order exists.',
            'code_buyer.required'     => 'No buyer cannot be empty.',
            'code_buyer.unique'       => 'No buyer exists.',
            'delivery_date.required'  => 'Delivery date cannot be empty.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = $production->update([
                'buyer_id'        => $request->buyer_id,
                'style_id'        => $request->style_id,
                'city_id'         => $request->city_id,
                'code_production' => Production::generateCodeProduction($request, $production->code),
                'code_job_order'  => $request->code_job_order,
                'code_buyer'      => $request->code_buyer,
                'delivery_date'   => $request->delivery_date
            ]);

            if($query) {
                ProductionDetail::where('production_id', $id)->delete();
                if($request->detail) {
                    foreach($request->detail as $key => $d) {
                        ProductionDetail::create([
                            'production_id'  => $id,
                            'color_id'       => $request->detail_color_id[$key],
                            'size_detail_id' => $request->detail_size_detail_id[$key],
                            'qty'            => $request->detail_qty[$key]
                        ]);
                    }
                }

                activity('production')
                    ->performedOn(new Production())
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
        $query = Production::destroy($request->id);
        if($query) {
            activity('production')
                ->performedOn(new Production())
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
