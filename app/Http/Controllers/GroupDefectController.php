<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Defect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GroupDefectController extends Controller {
    
    public function index()
    {
        $data = [
            'title'   => 'Group Defect',
            'content' => 'master_data.general.group_defect'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request) 
    {
        $column = [
            'id',
            'code',
            'name',
            'status',
            'updated_by',
            'created_at'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Defect::count();
        
        $query_data = Defect::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('code', 'like', "%$search%")
                            ->orWhere('name', 'like', "%$search%")
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

        $total_filtered = Defect::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('code', 'like', "%$search%")
                            ->orWhere('name', 'like', "%$search%")
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
                    $status = '<i class="icon-cross3"></i> Deactivate';
                } else {
                    $status = '<i class="icon-check"></i> Activate';
                }

                $response['data'][] = [
                    $nomor,
                    $val->code,
                    $val->name,
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
                                    <a href="javascript:void(0);" class="dropdown-item" onclick="show(' . $val->id . ')">
                                        <i class="icon-pencil"></i> Edit
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item" onclick="changeStatus(' . $val->id . ')">
                                        ' . $status . '
                                    </a>
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

    // public function create(Request $request)
    // {
    //     $validation = Validator::make($request->all(), [
    //         'name' => 'required'
    //     ], [
    //         'name.required' => 'Name cannot be empty.'
    //     ]);

    //     if($validation->fails()) {
    //         $response = [
    //             'status' => 422,
    //             'error'  => $validation->errors()
    //         ];
    //     } else {
    //         $query = City::create([
    //             'name' => $request->name
    //         ]);

    //         if($query) {
    //             activity()
    //                 ->performedOn(new City())
    //                 ->causedBy(session('bo_id'))
    //                 ->withProperties($query)
    //                 ->log('Add master city data');

    //             $response = [
    //                 'status'  => 200,
    //                 'message' => 'Data added successfully.'
    //             ];
    //         } else {
    //             $response = [
    //                 'status'  => 500,
    //                 'message' => 'Data failed to add.'
    //             ];
    //         }
    //     }

    //     return response()->json($response);
    // }

    // public function show(Request $request)
    // {
    //     $data = City::find($request->id);
    //     return response()->json($data);
    // }

    // public function update(Request $request, $id)
    // {
    //     $validation = Validator::make($request->all(), [
    //         'name' => 'required'
    //     ], [
    //         'name.required' => 'Name cannot be empty.'
    //     ]);

    //     if($validation->fails()) {
    //         $response = [
    //             'status' => 422,
    //             'error'  => $validation->errors()
    //         ];
    //     } else {
    //         $query = City::where('id', $id)->update([
    //             'name' => $request->name
    //         ]);

    //         if($query) {
    //             activity()
    //                 ->performedOn(new City())
    //                 ->causedBy(session('bo_id'))
    //                 ->log('Change the city master data');

    //             $response = [
    //                 'status'  => 200,
    //                 'message' => 'Data updated successfully.'
    //             ];
    //         } else {
    //             $response = [
    //                 'status'  => 500,
    //                 'message' => 'Data failed to update.'
    //             ];
    //         }
    //     }

    //     return response()->json($response);
    // }

    // public function destroy(Request $request) 
    // {
    //     $query = City::where('id', $request->id)->delete();
    //     if($query) {
    //         activity()
    //             ->performedOn(new City())
    //             ->causedBy(session('bo_id'))
    //             ->log('Delete the city master data');

    //         $response = [
    //             'status'  => 200,
    //             'message' => 'Data deleted successfully.'
    //         ];
    //     } else {
    //         $response = [
    //             'status'  => 500,
    //             'message' => 'Data failed to delete.'
    //         ];
    //     }

    //     return response()->json($response);
    // }

}
