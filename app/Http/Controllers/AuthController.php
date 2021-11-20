<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Token;
use App\Jobs\EmailJob;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller {

    public function login(Request $request)
    {
        session()->forget('confirmation');
        if(session('id')) {
            return redirect('dashboard');
        }

        if($request->has('_token') && csrf_token() == $request->_token) {
            if(RateLimiter::tooManyAttempts($request->ip(), 3)) {
                return abort(408);
            }

            $user = User::where([
                    ['username', '=', $request->username],
                    ['status', '=', 1]
                ])
                ->first();

            if($user) {
                if(Hash::check($request->password, $user->password)) {
                    $last_login = Carbon::now();
                    User::find($user->id)->update(['last_login' => $last_login]);
                    RateLimiter::clear($request->ip());
                    Token::where('user_id', $user->id)->update(['activated' => false]);

                    if($user->tfa) {
                        $agent          = new Agent();
                        $generate_token = Token::create([
                            'user_id'   => $user->id,
                            'code'      => rand(100000, 999999),
                            'valid_at'  => date('Y-m-d H:i:s', strtotime('+1 hour')),
                            'activated' => true
                        ]);

                        $email = [
                            'view'     => 'verification',
                            'to_email' => $user->email,
                            'to_name'  => $user->name,
                            'subject'  => 'Two Factor Authentication',
                            'data'     => [
                                'code'   => $generate_token->code,
                                'device' => '<b>' . $agent->platform() . ', ' . $agent->browser() . '</b>'
                            ]
                        ];

                        EmailJob::dispatch($email)->onQueue('email')->afterCommit();
                        return redirect('verification?for=' . encodeString($request->password) . '&user=' . encodeString($user->id));
                    }

                    session([
                        'id'         => $user->id,
                        'image'      => $user->image(),
                        'username'   => $user->username,
                        'email'      => $user->email,
                        'name'       => $user->name,
                        'gender'     => $user->gender,
                        'tfa'        => $user->tfa,
                        'last_login' => $last_login,
                        'status'     => $user->status()
                    ]);

                    activity('user')
                        ->performedOn(new User())
                        ->causedBy(session('id'))
                        ->log('login');

                    Token::where('user_id', $user->id)->update(['activated' => false]);
                    return redirect('dashboard');
                } else {
                    RateLimiter::hit($request->ip(), 3600);
                    return redirect()->back()->with(['failed' => 'Account not found']);
                }
            } else {
                RateLimiter::hit($request->ip(), 3600);
                return redirect()->back()->with(['failed' => 'Account not found.']);
            }
        }

        return view('login');
    }

    public function verification(Request $request)
    {
        if($request->missing('for') || $request->missing('user')) {
            return redirect('/');
        }

        $password = decodeString($request->for);
        $id       = decodeString($request->user);

        if($request->has('_token') && csrf_token() == $request->_token) {
            $user = User::find($id);
            if($user) {
                if(Hash::check($password, $user->password)) {
                    $last_login = Carbon::now();
                    User::find($user->id)->update(['last_login' => $last_login]);

                    $token = $user->token()
                        ->where('code', $request->code)
                        ->whereDate('valid_at', date('Y-m-d'))
                        ->whereTime('valid_at', '>=', date('H:i:s'))
                        ->where('activated', true)
                        ->orderByDesc('id')
                        ->limit(1)
                        ->get();

                    if($token->count() > 0) {
                        session([
                            'id'         => $user->id,
                            'image'      => $user->image(),
                            'username'   => $user->username,
                            'email'      => $user->email,
                            'name'       => $user->name,
                            'gender'     => $user->gender,
                            'tfa'        => $user->tfa,
                            'last_login' => $last_login,
                            'status'     => $user->status()
                        ]);

                        activity('user')
                            ->performedOn(new User())
                            ->causedBy(session('id'))
                            ->log('login');

                        return redirect('dashboard');
                    } else {
                        return redirect()->back()->with(['failed' => 'Invalid code']);
                    }
                } else {
                    return redirect()->back()->with(['failed' => 'Authentication denied']);
                }
            } else {
                return redirect()->back()->with(['failed' => 'User not found']);
            }
        }

        return view('verification');
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
