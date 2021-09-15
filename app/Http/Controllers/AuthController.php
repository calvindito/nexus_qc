<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {

    public function index(Request $request)
    {
        if(session('id')) {
            return redirect()->back();
        }

        if($request->has('_token') && session()->token() == $request->_token) {
            $user = User::where([
                ['username', '=', $request->username],
                ['status', '=', 1]
            ])
            ->first();

            if($user) {
                if(Hash::check($request->password, $user->password)) {
                    session([
                        'id'       => $user->id,
                        'image'    => $user->image(),
                        'username' => $user->username,
                        'email'    => $user->email,
                        'name'     => $user->name
                    ]);

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
        session()->flush();
        return redirect('/')->with(['success' => 'You have logged out']);
    }

}
