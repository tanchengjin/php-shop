<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $lang = Session::has('lang') ? Session::get('lang') : 'zh-CN';

        if (in_array($lang, ['en', 'zh'])) {
            if($lang === 'zh'){
               $lang='zh-CN';
            }
            App::setLocale($lang);
        }
        return $next($request);
    }
}
