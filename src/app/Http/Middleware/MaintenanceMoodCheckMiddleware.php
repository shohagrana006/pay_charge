<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MaintenanceMoodCheckMiddleware
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
        $maintenanceMood =  generalSetting()->maintenance_mood;
        if ($maintenanceMood == 'Active' && !$request->is('admin/*') ){
            abort(403,decode('Site Under Maintenance Mode !!'));
        }
        return $next($request);
    }
}
