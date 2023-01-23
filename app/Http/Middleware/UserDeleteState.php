<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserDeleteState
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
        if (Auth::check() && Auth::user()->status == 0) {

            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            // Session::flash('success', 'You logged out successfully.');
            Session::flash('info', '您的帐户暂停，请联系管理员。');

            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
