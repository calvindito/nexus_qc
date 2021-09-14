<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\SizeDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GroupSizeController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'Master Data - General - Group Size',
            'content' => 'master_data.general.group_size'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request)
    {
        $column = [
            'id',
            'type',
            'value',
            'status',
            'updated_by',
            'created_at'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Size::count();

        $query_data = Size::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->whereHas('updatedBy', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhereHas('sizeDetail', function($query) use ($search) {
                                $query->where('value', 'like', "%$search%");
                            });
                    });
                }
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = Size::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->whereHas('updatedBy', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhereHas('sizeDetail', function($query) use ($search) {
                                $query->where('value', 'like', "%$search%");
                            });
                    });
                }
            })
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            $nomor = $start + 1;
            foreach($query_data as $val) {
                $value = '';
                if($val->sizeDetail) {
                    foreach($val->sizeDetail as $sd) {
                        $value .= '<span class="badge badge-flat border-secondary text-secondary mb-2 mr-2">' . $sd->value . '</span>';
                    }
                } else {
                    $value .= 'Value not selected';
                }

                $response['data'][] = [
                    $nomor,
                    $val->type(),
                    $value,
                    $val->status(),
                    $val->updatedBy->name,
                    $val->created_at->format('d F Y')
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
            'type'   => 'required',
            'value'  => 'required',
            'status' => 'required'
        ], [
            'type.required'   => 'Please select a type.',
            'value.required'  => 'Size chart cannot be empty.',
            'status.required' => 'Please select a status.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = Size::create([
                'created_by' => session('id'),
                'updated_by' => session('id'),
                'type'       => $request->type,
                'status'     => $request->status
            ]);

            if($query) {
                if($request->value) {
                    foreach($request->value as $v) {
                        SizeDetail::create([
                            'size_id' => $query->id,
                            'value'   => $v
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

    public function update(Request $request)
    {
        $query = Size::find($request->id)->update([
            'updated_by' => session('id'),
            'status'     => $request->status
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

        return response()->json($response);
    }

}