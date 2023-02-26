<?php

namespace App\Http\Middleware;

use App\Http\Repositories\Eternal\GeneralRepository;
use Closure;
use Illuminate\Http\Request;

class ApiLangMiddleware
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
        if($request->hasHeader('X-localization')){
            if($request->header('X-localization') != 'null'){
                $locale =  $request->header('X-localization');
            } else{
                $locale = (GeneralRepository::findElement('Language', '1', 'is_default'))->code;       
            }
        } else{
            $locale = (GeneralRepository::findElement('Language', '1', 'is_default'))->code;       
        }
        app()->setLocale($locale);
        return $next($request);
    }
}
