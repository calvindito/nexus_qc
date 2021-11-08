<?php

namespace App\Http\Controllers;

use App\Models\User;
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

}
