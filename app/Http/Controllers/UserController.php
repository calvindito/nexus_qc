<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'Setting - User',
            'content' => 'setting.user'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request)
    {
        $column = [
            'no',
            'id',
            'image',
            'name',
            'email',
            'gender',
            'last_login',
            'status',
            'updated_by',
            'created_at'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = User::count();

        $query_data = User::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('name', 'like', "%$search%")
                            ->orWhere('email', 'like', "%$search%")
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

        $total_filtered = User::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('name', 'like', "%$search%")
                            ->orWhere('email', 'like', "%$search%")
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

                $image = '<a href="' . $val->image() . '" data-lightbox="image-' . $val->id . '" data-title="' . $val->name . '"><img src="' . $val->image() . '" class="img-preview rounded"></a>';

                $response['data'][] = [
                    $nomor,
                    $val->id,
                    $image,
                    $val->name,
                    $val->email,
                    $val->gender(),
                    $val->last_login ? date('d M Y, H:i', strtotime($val->last_login)) : '-',
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
                                    <a href="javascript:void(0);" onclick="resetPassword(' . $val->id . ')" class="dropdown-item"><i class="icon-lock5"></i> Reset Password</a>
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
            'image'    => 'image|mimes:png,jpg,jpeg',
            'username' => 'required|unique:mysql.users,username',
            'name'     => 'required',
            'email'    => 'required|email|unique:mysql.users,email',
            'gender'   => 'required',
            'status'   => 'required'
        ], [
            'image.image'       => 'Image not valid.',
            'image.mimes'       => 'Only files image with png, jpg, jpeg extension are allowed.',
            'username.required' => 'Username cannot be empty.',
            'username.unique'   => 'Username exists.',
            'name.required'     => 'Name cannot be empty.',
            'email.required'    => 'Email cannot be empty.',
            'email.email'       => 'Email not valid.',
            'email.unique'      => 'Email exists.',
            'gender.required'   => 'Please select a gender.',
            'status.required'   => 'Please select a status.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = User::create([
                'created_by' => session('id'),
                'updated_by' => session('id'),
                'image'      => $request->hasFile('image') ? $request->file('image')->store('public/user') : null,
                'username'   => $request->username,
                'name'       => $request->name,
                'email'      => $request->email,
                'gender'     => $request->gender,
                'password'   => Hash::make('NexusQc21'),
                'status'     => $request->status
            ]);

            if($query) {
                activity('user')
                    ->performedOn(new User())
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
        $data = User::find($request->id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $user       = User::find($id);
        $validation = Validator::make($request->all(), [
            'image'    => 'image|mimes:png,jpg,jpeg',
            'username' => ['required', Rule::unique('mysql.users', 'username')->ignore($id)],
            'name'     => 'required',
            'email'    => ['required', 'email', Rule::unique('mysql.users', 'email')->ignore($id)],
            'gender'   => 'required',
            'status'   => 'required'
        ], [
            'image.image'       => 'Image not valid.',
            'image.mimes'       => 'Only files image with png, jpg, jpeg extension are allowed.',
            'username.required' => 'Username cannot be empty.',
            'username.unique'   => 'Username exists.',
            'name.required'     => 'Name cannot be empty.',
            'email.required'    => 'Email cannot be empty.',
            'email.email'       => 'Email not valid.',
            'email.unique'      => 'Email exists.',
            'gender.required'   => 'Please select a gender.',
            'status.required'   => 'Please select a status.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            if($request->hasFile('image')) {
                if(Storage::exists($user->image)) {
                    Storage::delete($user->image);
                }

                $image = $request->file('image')->store('public/user');
            } else {
                $image = $user->image;
            }

            $user->update([
                'updated_by' => session('id'),
                'image'      => $image,
                'username'   => $request->username,
                'name'       => $request->name,
                'email'      => $request->email,
                'gender'     => $request->gender,
                'status'     => $request->status
            ]);

            if($query) {
                activity('user')
                    ->performedOn(new User())
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
        $query = User::find($request->id)->update(['status' => $request->status]);
        if($query) {
            activity('user')
                ->performedOn(new User())
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

    public function resetPassword(Request $request)
    {
        $query = User::find($request->id)->update(['password' => Hash::make('NexusQc21')]);
        if($query) {
            activity('user')
                ->performedOn(new User())
                ->causedBy(session('id'))
                ->log('reset password');

            $response = [
                'status'  => 200,
                'message' => 'Password has been reset.'
            ];
        } else {
            $response = [
                'status'  => 500,
                'message' => 'Failed to reset password.'
            ];
        }

        return response()->json($response);
    }

    public function destroy(Request $request)
    {
        $query = User::destroy($request->id);
        if($query) {
            activity('user')
                ->performedOn(new User())
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
