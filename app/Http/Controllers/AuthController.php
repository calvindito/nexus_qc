<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {

    public function login(Request $request)
    {
        if(session('id')) {
            return redirect()->back();
        }

        if($request->has('_token') && csrf_token() == $request->_token) {
            $user = User::where([
                ['username', '=', $request->username],
                ['status', '=', 1]
            ])
            ->first();

            if($user) {
                if(Hash::check($request->password, $user->password)) {
                    $last_login = Carbon::now();
                    User::find($user->id)->update(['last_login' => $last_login]);

                    session([
                        'id'         => $user->id,
                        'image'      => $user->image(),
                        'username'   => $user->username,
                        'email'      => $user->email,
                        'name'       => $user->name,
                        'gender'     => $user->gender,
                        'last_login' => $user->last_login ? $user->last_login : $last_login,
                        'status'     => $user->status()
                    ]);

                    activity('user')
                        ->performedOn(new User())
                        ->causedBy(session('id'))
                        ->log('login');

                    return redirect('dashboard');
                } else {
                    return redirect()->back()->with(['failed' => 'Account not found']);
                }
            } else {
                return redirect()->back()->with(['failed' => 'Account not found']);
            }
        } else {
            return view('login');
        }
    }

    public function logout()
    {
        activity('user')
            ->performedOn(new User())
            ->causedBy(session('id'))
            ->log('logout');

        session()->flush();
        return redirect('/')->with(['success' => 'You have logged out']);
    }

}
