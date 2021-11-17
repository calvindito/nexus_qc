<?php

namespace App\Http\Controllers;

use App\Models\CheckPoint;
use App\Models\GroupDefect;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Models\ProductTypeDefect;
use App\Http\Controllers\Controller;
use App\Models\ProductTypeCheckPoint;

class ManageProductController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'Product - Manage',
            'content' => 'product.manage'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request)
    {
        $column = [
            'id',
            'product_class_id',
            'name'
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
                            ->orWhereHas('productClass', function($query) use ($search) {
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
                            ->orWhereHas('productClass', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            });
                    });
                }
            })
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            $nomor = 1;
            foreach($query_data as $val) {
                $response['data'][] = [
                    $nomor,
                    $val->productClass->name,
                    $val->name,
                    '
                        <a href="javascript:void(0);" class="badge badge-success btn-sm" onclick="chooseProduct(' . $val->id . ')">Choose</a>
                    '
                ];
            }
            $nomor++;
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

    public function loadContent(Request $request)
    {
        $type_product     = ProductType::find($request->id);
        $check_point      = CheckPoint::where('status', 1)->get();
        $defect           = GroupDefect::where('type', 3)->where('status', 1)->get();
        $group_size       = '';
        $data_check_point = [];
        $data_defect      = [];

        if($type_product->size->sizeDetail) {
            foreach($type_product->size->sizeDetail as $key => $sd) {
                $separator   = $key + 1 == $type_product->size->sizeDetail->count() ? '' : ', ';
                $group_size .= $sd->value . $separator;
            }
        }

        foreach($check_point as $cp) {
            $data               = $type_product->productTypeCheckPoint()->where('check_point_id', $cp->id)->first();
            $existsable         = $data ? $data->hasRelation() : false;
            $disable            = $existsable ? 'disabled' : '';
            $selected           = $data ? 'selected' : '';
            $data_check_point[] = '<option value="' . $cp->id . '" ' . $selected . ' ' . $disable . '>' . $cp->name . '</option>';
        }

        if($type_product->productTypeCheckPoint) {
            foreach($type_product->productTypeCheckPoint as $key => $ptcp) {
                $string_defect = '';
                foreach($defect as $d) {
                    $data = $type_product->productTypeDefect()
                        ->where('product_type_check_point_id', $ptcp->id)
                        ->where('group_defect_id', $d->id)
                        ->first();

                    $selected       = $data ? 'selected' : '';
                    $string_defect .= '<option value="' . $d->id . '" ' . $selected . '>' . $d->name . '</option>';
                }

                $button = '
                    <button type="button" class="btn btn-teal-100 btn-sm text-teal border-teal btn-icon" data-toggle="modal" data-target="#modal_defect' . $ptcp->id . '"><i class="icon-eye"></i></button>
                    <div class="modal fade" id="modal_defect' . $ptcp->id . '" data-backdrop="static" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h5 class="modal-title">Form Defect</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <select name="group_defect_id' . $ptcp->id . '[]" id="group_defect_id' . $ptcp->id . '" multiple="multiple" class="form-control">
                                            ' . $string_defect . '
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                ';

                $data_defect[] = [
                    'no'       => $key + 1,
                    'code'     => $ptcp->checkPoint->code,
                    'name'     => $ptcp->checkPoint->name,
                    'button'   => $button,
                    'selector' => '#group_defect_id' . $ptcp->id
                ];
            }
        }

        return response()->json([
            'type_product'       => $type_product->name,
            'description'        => $type_product->description,
            'class_product'      => $type_product->productClass->name,
            'group_size'         => $group_size,
            'smv_global'         => $type_product->smv_global,
            'created_by'         => $type_product->createdBy->name,
            'modified_by'        => $type_product->updatedBy->name,
            'date_created'       => $type_product->created_at->format('d F Y, H:i'),
            'last_modified_date' => $type_product->updated_at->format('d F Y, H:i'),
            'status'             => $type_product->status(),
            'check_point'        => $data_check_point,
            'defect'             => $data_defect
        ]);
    }

    public function submitable(Request $request)
    {
        $type_product = ProductType::find($request->product_type_id);
        if($request->param == 'check_point') {
            if($type_product->productTypeCheckPoint->count() > 0) {
                ProductTypeCheckPoint::doesntHave('productTypeDefect')
                    ->where('product_type_id', $type_product->id)
                    ->delete();
            }

            if($request->check_point_id) {
                foreach($request->check_point_id as $cpi) {
                    ProductTypeCheckPoint::create([
                        'product_type_id' => $type_product->id,
                        'check_point_id'  => $cpi
                    ]);
                }
            }

            activity('type product')
                ->performedOn(new ProductTypeCheckPoint())
                ->causedBy(session('id'))
                ->log('manage check point type product');

            $response = [
                'status'  => 200,
                'message' => 'Data has been processed'
            ];
        } else if($request->param == 'defect') {
            if($type_product->productTypeDefect->count() > 0) {
                ProductTypeDefect::where('product_type_id', $type_product->id)->delete();
            }

            foreach($type_product->productTypeCheckPoint as $ptcp) {
                $group_defect_id = $request->input('group_defect_id' . $ptcp->id);
                if(is_array($group_defect_id)) {
                    if(count($group_defect_id) > 0) {
                        foreach($group_defect_id as $gdi) {
                            ProductTypeDefect::create([
                                'product_type_id'             => $type_product->id,
                                'product_type_check_point_id' => $ptcp->id,
                                'group_defect_id'             => $gdi
                            ]);
                        }
                    }
                }
            }

            activity('type product')
                ->performedOn(new ProductTypeDefect())
                ->causedBy(session('id'))
                ->log('manage defect type product');

            $response = [
                'status'  => 200,
                'message' => 'Data has been processed'
            ];
        } else {
            $response = [
                'status'  => 500,
                'message' => 'Something wrong'
            ];
        }

        return response()->json($response);
    }

}
