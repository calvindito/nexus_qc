<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class AuthLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user_id = session('id');
        $user    = User::where('id', $user_id)
            ->where('last_login', session('last_login'))
            ->where('status', 1)
            ->first();

        if($user_id && $user) {
            session([
                'id'         => $user->id,
                'image'      => $user->image(),
                'username'   => $user->username,
                'email'      => $user->email,
                'name'       => $user->name,
                'gender'     => $user->gender,
                'tfa'        => $user->tfa,
                'last_login' => $user->last_login,
                'status'     => $user->status()
            ]);

            return $next($request);
        } else {
            session()->flush();
            return redirect('/');
        }
    }
}
