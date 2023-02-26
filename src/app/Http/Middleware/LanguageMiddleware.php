<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Repositories\Eternal\GeneralRepository;
class LanguageMiddleware
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

        if(session()->has('locale')){
            $locale = session()->get('locale');
        }
        else{
            $locale = (GeneralRepository::findElement('Language', '1', 'is_default'))->code;
        }
        App::setLocale($locale);
        session()->put('locale', $locale);
        return $next($request);
    }
}
