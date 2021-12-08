<?php

namespace App\Http\Controllers;

use App\Models\Style;
use Illuminate\Http\Request;
use App\Models\StandartMinuteValue;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StandartMinuteValueController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'Working Hours - SMV',
            'style'   => Style::where('status', 1)->get(),
            'content' => 'working_hours.smv'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request)
    {
        $column = [
            'no',
            'id',
            'brand_id',
            'product_class_id',
            'product_type_id',
            'style_id',
            'target',
            'smv_global',
            'smv_style',
            'status',
            'updated_by',
            'created_at'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = StandartMinuteValue::count();

        $query_data = StandartMinuteValue::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->whereHas('style', function($query) use ($search) {
                            $query->where('name', 'like', "%$search%")
                                ->orWhereHas('brand', function($query) use ($search) {
                                    $query->where('name', 'like', "%$search%");
                                })
                                ->orWhereHas('productClass', function($query) use ($search) {
                                    $query->where('name', 'like', "%$search%");
                                })
                                ->orWhereHas('productType', function($query) use ($search) {
                                    $query->where('name', 'like', "%$search%");
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

        $total_filtered = StandartMinuteValue::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->whereHas('style', function($query) use ($search) {
                            $query->where('name', 'like', "%$search%")
                                ->orWhereHas('brand', function($query) use ($search) {
                                    $query->where('name', 'like', "%$search%");
                                })
                                ->orWhereHas('productClass', function($query) use ($search) {
                                    $query->where('name', 'like', "%$search%");
                                })
                                ->orWhereHas('productType', function($query) use ($search) {
                                    $query->where('name', 'like', "%$search%");
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
                    sprintf('%04s', $val->id),
                    $val->style->brand->name,
                    $val->style->productClass->name,
                    $val->style->productType->name,
                    $val->style->name,
                    $val->target . ' Minutes',
                    $val->style->productType->smv_global,
                    '-',
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

    public function getDataStyle(Request $request)
    {
        $data = Style::find($request->id);
        return response()->json([
            'brand'         => $data ? $data->brand->name : '',
            'product_class' => $data ? $data->productClass->name : '',
            'product_type'  => $data ? $data->productType->name : '',
            'smv_global'    => $data ? $data->productType->smv_global : ''
        ]);
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'style_id' => 'required',
            'target'   => 'required'
        ], [
            'style_id.required' => 'Please select a style.',
            'target.required'   => 'SMV target cannot be a empty.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = StandartMinuteValue::create([
                'style_id'   => $request->style_id,
                'created_by' => session('id'),
                'updated_by' => session('id'),
                'target'     => $request->target,
                'status'     => $request->status
            ]);

            if($query) {
                activity('smv')
                    ->performedOn(new StandartMinuteValue())
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
        $data = StandartMinuteValue::find($request->id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'style_id' => 'required',
            'target'   => 'required'
        ], [
            'style_id.required' => 'Please select a style.',
            'target.required'   => 'SMV target cannot be a empty.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = StandartMinuteValue::find($id)->update([
                'style_id'   => $request->style_id,
                'updated_by' => session('id'),
                'target'     => $request->target,
                'status'     => $request->status
            ]);

            if($query) {
                activity('smv')
                    ->performedOn(new StandartMinuteValue())
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
        $query = StandartMinuteValue::find($request->id)->update(['status' => $request->status]);
        if($query) {
            activity('smv')
                ->performedOn(new StandartMinuteValue())
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
        $query = StandartMinuteValue::destroy($request->id);
        if($query) {
            activity('smv')
                ->performedOn(new StandartMinuteValue())
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
