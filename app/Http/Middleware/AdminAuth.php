<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminAuth
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
        if(!Session::has('admin')) {
            // Session::flash('error', 'Please log in');
            Session::flash('error', '请登录。');
            return redirect()->route('admin.login');
        }
        if(Auth::user()->status > 1) {
            // Session::flash('error', 'Sorry, Not a valid user!');
            Session::flash('error', '抱歉，不是有效用户！');
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}
