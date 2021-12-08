<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\GroupDefect;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Models\ProductTypeDefect;
use App\Http\Controllers\Controller;
use App\Models\ProductTypePosition;

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
                        $query->where('name', 'like', "%$search%");
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
                        $query->where('name', 'like', "%$search%");
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
                    $val->name,
                    '
                        <a href="javascript:void(0);" class="badge badge-success btn-sm" onclick="chooseProduct(' . $val->id . ')">Choose</a>
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

    public function loadContent(Request $request)
    {
        $type_product  = ProductType::find($request->id);
        $position      = Position::where('status', 1)->get();
        $defect        = GroupDefect::where('type', 2)->where('status', 1)->get();
        $data_position = [];
        $data_defect   = [];

        foreach($position as $p) {
            $data            = $type_product->productTypePosition()->where('position_id', $cp->id)->first();
            $existsable      = $data ? $data->hasRelation() : false;
            $disable         = $existsable ? 'disabled' : '';
            $selected        = $data ? 'selected' : '';
            $data_position[] = '<option value="' . $cp->id . '" ' . $selected . ' ' . $disable . '>' . $cp->name . '</option>';
        }

        if($type_product->productTypePosition) {
            foreach($type_product->productTypePosition as $key => $ptcp) {
                $string_defect = '';
                foreach($defect as $d) {
                    $data = $type_product->productTypeDefect()
                        ->where('product_type_position_id', $ptcp->id)
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
                    'name'     => $ptcp->position->name,
                    'button'   => $button,
                    'selector' => '#group_defect_id' . $ptcp->id
                ];
            }
        }

        return response()->json([
            'type_product'       => $type_product->name,
            'group'              => $type_product->productGroup->name,
            'smv_global'         => $type_product->smv_global,
            'created_by'         => $type_product->createdBy->name,
            'modified_by'        => $type_product->updatedBy->name,
            'date_created'       => $type_product->created_at->format('d F Y, H:i'),
            'last_modified_date' => $type_product->updated_at->format('d F Y, H:i'),
            'status'             => $type_product->status(),
            'position'           => $data_position,
            'defect'             => $data_defect
        ]);
    }

    public function submitable(Request $request)
    {
        $type_product = ProductType::find($request->product_type_id);
        if($request->param == 'position') {
            if($type_product->productTypePosition->count() > 0) {
                ProductTypePosition::doesntHave('productTypeDefect')
                    ->where('product_type_id', $type_product->id)
                    ->delete();
            }

            if($request->position_id) {
                foreach($request->position_id as $cpi) {
                    ProductTypePosition::create([
                        'product_type_id' => $type_product->id,
                        'position_id'     => $cpi
                    ]);
                }
            }

            activity('type product')
                ->performedOn(new ProductTypePosition())
                ->causedBy(session('id'))
                ->log('manage position type product');

            $response = [
                'status'  => 200,
                'message' => 'Data has been processed'
            ];
        } else if($request->param == 'defect') {
            if($type_product->productTypeDefect->count() > 0) {
                ProductTypeDefect::where('product_type_id', $type_product->id)->delete();
            }

            foreach($type_product->productTypePosition as $ptcp) {
                $group_defect_id = $request->input('group_defect_id' . $ptcp->id);
                if(is_array($group_defect_id)) {
                    if(count($group_defect_id) > 0) {
                        foreach($group_defect_id as $gdi) {
                            ProductTypeDefect::create([
                                'product_type_id'          => $type_product->id,
                                'product_type_position_id' => $ptcp->id,
                                'group_defect_id'          => $gdi
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
