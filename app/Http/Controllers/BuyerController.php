<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Models\Buyer;
use App\Models\Country;
use App\Models\Departement;
use App\Models\BuyerContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BuyerController extends Controller {

    public function index()
    {
        $data = [
            'title'       => 'Master Data - General - Buyer',
            'country'     => Country::orderBy('name', 'asc')->get(),
            'departement' => Departement::where('status', 'Active')->get(),
            'rank'        => Rank::where('status', 'Active')->get(),
            'content'     => 'master_data.general.buyer'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request)
    {
        $column = [
            'row_detail',
            'id',
            'company',
            'description',
            'address',
            'city_id',
            'province_id',
            'country_id',
            'remark',
            'status',
            'updated_by',
            'created_at'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Buyer::count();

        $query_data = Buyer::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('company', 'like', "%$search%")
                            ->orWhere('description', 'like', "%$search%")
                            ->orWhere('address', 'like', "%$search%")
                            ->orWhere('remark', 'like', "%$search%")
                            ->orWhereHas('city', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhereHas('province', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhereHas('country', function($query) use ($search) {
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

        $total_filtered = Buyer::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('company', 'like', "%$search%")
                            ->orWhere('description', 'like', "%$search%")
                            ->orWhere('address', 'like', "%$search%")
                            ->orWhere('remark', 'like', "%$search%")
                            ->orWhereHas('city', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhereHas('province', function($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            })
                            ->orWhereHas('country', function($query) use ($search) {
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
            foreach($query_data as $val) {
                $response['data'][] = [
                    '<span class="text-success" data-id="' . $val->id . '"><i class="icon-plus-circle2"></i></span>',
                    $val->id,
                    $val->company,
                    $val->description,
                    $val->address,
                    $val->city->name,
                    $val->province->name,
                    $val->country->name,
                    $val->remark,
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
                                    <a href="javascript:void(0);" onclick="changeStatus(' . $val->id . ', 1)" class="dropdown-item"><i class="icon-check"></i> Active</a>
                                    <a href="javascript:void(0);" onclick="changeStatus(' . $val->id . ', 2)" class="dropdown-item"><i class="icon-cross"></i> Inactive</a>
                                </div>
                            </div>
                        </div>
                    '
                ];
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

    public function rowDetail(Request $request)
    {
        $data    = Buyer::find($request->id);
        $contact = '<div class="list-group d-inline-block"><div class="row">';

        for($i = 1; $i <= 4; $i++) {
            $buyer_contact = $data->buyerContact()->where('type', $i)->get();
            if($buyer_contact->count() > 0) {
                foreach($buyer_contact as $bc) {
                    $contact .= '
                        <div class="col-md-6">
                            <a href="javascript:void(0);" class="no-pointer list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <div class="font-weight-bold mb-1">' . $bc->name . '</div>
                                    <small>' . $bc->type() . '</small>
                                </div>
                                <p><small class="mb-1">' . $bc->value . '</small></p>
                                <small>' . $bc->rank->rank . '</small>
                            </a>
                        </div>
                    ';
                }
            }
        }

        $content = '
            <div class="form-group row mb-0">
                <label class="col-form-label col-lg-1 font-weight-bold">Departement</label>
                <div class="col-lg-11">
                    <div class="form-control-plaintext">:&nbsp;&nbsp;' . $data->departement->department . '</div>
                </div>
            </div>
            <div class="form-group mb-0"><hr></div>
        ';

        return response()->json($content . $contact . '</div></div>');
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'country_id'     => 'required',
            'province_id'    => 'required',
            'city_id'        => 'required',
            'departement_id' => 'required',
            'company'        => 'required',
            'description'    => 'required',
            'remark'         => 'required',
            'address'        => 'required',
            'status'         => 'required'
        ], [
            'country_id.required'     => 'Please select a country.',
            'province_id.required'    => 'Please select a province.',
            'city_id.required'        => 'Please select a city.',
            'departement_id.required' => 'Please select a departement.',
            'company.required'        => 'Company cannot be empty.',
            'description.required'    => 'Description cannot be empty.',
            'remark.required'         => 'Remark cannot be empty.',
            'address.required'        => 'Address cannot be empty.',
            'status.required'         => 'Please select a status.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = Buyer::create([
                'country_id'     => $request->country_id,
                'province_id'    => $request->province_id,
                'city_id'        => $request->city_id,
                'departement_id' => $request->departement_id,
                'created_by'     => session('id'),
                'updated_by'     => session('id'),
                'company'        => $request->company,
                'description'    => $request->description,
                'remark'         => $request->remark,
                'address'        => $request->address,
                'status'         => $request->status
            ]);

            if($query) {
                if($request->contact) {
                    foreach($request->contact as $key => $c) {
                        BuyerContact::create([
                            'buyer_id' => $query->id,
                            'rank_id'  => $request->contact_rank_id[$key],
                            'name'     => $request->contact_name[$key],
                            'value'    => $request->contact_value[$key],
                            'type'     => $request->contact_type[$key]
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

    public function show(Request $request)
    {
        $contact = [];
        $data    = Buyer::find($request->id);

        if($data->buyerContact) {
            foreach($data->buyerContact as $bc) {
                $contact[] = [
                    'rank_id'   => $bc->rank_id,
                    'rank_name' => $bc->rank->rank,
                    'name'      => $bc->name,
                    'value'     => $bc->value,
                    'type'      => $bc->type,
                    'type_name' => $bc->type()
                ];
            }
        }

        return response()->json([
            'country_id'     => $data->country_id,
            'province_id'    => $data->province_id,
            'city_id'        => $data->city_id,
            'departement_id' => $data->departement_id,
            'company'        => $data->company,
            'description'    => $data->description,
            'remark'         => $data->remark,
            'address'        => $data->address,
            'status'         => $data->status,
            'contact'        => $contact
        ]);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'country_id'     => 'required',
            'province_id'    => 'required',
            'city_id'        => 'required',
            'departement_id' => 'required',
            'company'        => 'required',
            'description'    => 'required',
            'remark'         => 'required',
            'address'        => 'required',
            'status'         => 'required'
        ], [
            'country_id.required'     => 'Please select a country.',
            'province_id.required'    => 'Please select a province.',
            'city_id.required'        => 'Please select a city.',
            'departement_id.required' => 'Please select a departement.',
            'company.required'        => 'Company cannot be empty.',
            'description.required'    => 'Description cannot be empty.',
            'remark.required'         => 'Remark cannot be empty.',
            'address.required'        => 'Address cannot be empty.',
            'status.required'         => 'Please select a status.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = Buyer::find($id)->update([
                'country_id'     => $request->country_id,
                'province_id'    => $request->province_id,
                'city_id'        => $request->city_id,
                'departement_id' => $request->departement_id,
                'updated_by'     => session('id'),
                'company'        => $request->company,
                'description'    => $request->description,
                'remark'         => $request->remark,
                'address'        => $request->address,
                'status'         => $request->status
            ]);

            if($query) {
                BuyerContact::where('buyer_id', $id)->delete();
                if($request->contact) {
                    foreach($request->contact as $key => $c) {
                        BuyerContact::create([
                            'buyer_id' => $id,
                            'rank_id'  => $request->contact_rank_id[$key],
                            'name'     => $request->contact_name[$key],
                            'value'    => $request->contact_value[$key],
                            'type'     => $request->contact_type[$key]
                        ]);
                    }
                }

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
        $query = Buyer::find($request->id)->update(['status' => $request->status]);
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
