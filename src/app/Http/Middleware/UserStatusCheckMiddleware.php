<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserStatusCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // dd('here');
        if(authCheck()){
            // dd('here');
            if(authUser('web')->status != 'Active'){
                Auth::guard('web')->logout();
                // $request->session()->invalidate();
                // $request->session()->regenerateToken();
                return redirect()->route('home')->with('error',decode("your account is Deactivated"));
            }
        }
        return $next($request);
    }
}
