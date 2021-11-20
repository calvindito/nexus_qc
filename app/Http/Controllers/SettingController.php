<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller {

    public function account(Request $request)
    {
        $data = [
            'title'   => 'Setting - Account',
            'content' => 'setting.account'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function profile(Request $request)
    {
        $query      = User::find(session('id'));
        $validation = Validator::make($request->all(), [
            'image'    => 'max:2048|mimes:jpg,jpeg,png',
            'username' => ['required', Rule::unique('mysql.users', 'username')->ignore($query->id)],
            'name'     => 'required',
            'email'    => ['required', Rule::unique('mysql.users', 'email')->ignore($query->id)],
            'gender'   => 'required'
        ], [
            'image.max'         => 'Image max 2MB.',
            'image.mimes'       => 'Only extensions allowed are jpg, jpeg, png.',
            'username.required' => 'Username cannot be empty.',
            'Username.unique'   => 'Username exists.',
            'name.required'     => 'Name cannot be empty.',
            'email.required'    => 'Email cannot be empty.',
            'email.unique'      => 'Email exists.',
            'gender.required'   => 'Please select a gender.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            if($request->hasFile('image')) {
                if(Storage::exists($query->image)) {
                    Storage::delete($query->image);
                }

                $image = $request->file('image')->store('public/user');
            } else {
                $image = $query->image;
            }

            $query = User::find($query->id)->update([
                'updated_by' => session('id'),
                'image'      => $image,
                'username'   => $request->username,
                'name'       => $request->name,
                'email'      => $request->email,
                'gender'     => $request->gender
            ]);

            if($query) {
                activity('user')
                    ->performedOn(new User())
                    ->causedBy(session('id'))
                    ->log('edit profile');

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

    public function changePassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'password'         => 'required',
            'confirm_password' => 'required|same:password'
        ], [
            'password.required'         => 'Password cannot be empty.',
            'confirm_password.required' => 'Confirmation password cannot be empty.',
            'confirm_password.same'     => 'Confirmation password does not match.'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $query = User::find(session('id'))->update([
                'updated_by' => session('id'),
                'password'   => Hash::make($request->password)
            ]);

            if($query) {
                activity('user')
                    ->performedOn(new User())
                    ->causedBy(session('id'))
                    ->log('change password');

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

    public function loadActivity(Request $request)
    {
        $column = [
            'id',
            'log_name',
            'description',
            'created_at'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = ActivityLog::where('causer_id', session('id'))
            ->count();

        $query_data = ActivityLog::where('causer_id', session('id'))
            ->where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('log_name', 'like', "%$search%")
                            ->orWhere('description', 'like', "%$search%");
                    });
                }
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = ActivityLog::where('causer_id', session('id'))
            ->where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('log_name', 'like', "%$search%")
                            ->orWhere('description', 'like', "%$search%");
                    });
                }
            })
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            $nomor = $start + 1;
            foreach($query_data as $val) {
                $response['data'][] = [
                    $nomor,
                    ucwords($val->log_name),
                    $val->description,
                    $val->created_at->format('M d, Y') . ' at ' . $val->created_at->format('H:i A')
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

    public function twoFactorAuthentication(Request $request)
    {
        $query = User::find(session('id'))->update(['tfa' => $request->tfa]);
        if($query) {
            activity('user')
                ->performedOn(new User())
                ->causedBy(session('id'))
                ->log('change two factor authentication');

            $response = [
                'status'  => 200,
                'message' => '2FA has been changed.'
            ];
        } else {
            $response = [
                'status'  => 500,
                'message' => 'Failed to change 2FA.'
            ];
        }

        return response()->json($response);
    }

}
