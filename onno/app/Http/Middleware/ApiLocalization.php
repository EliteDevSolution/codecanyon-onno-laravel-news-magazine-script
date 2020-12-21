<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Modules\Language\Entities\Language;

class ApiLocalization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check header request and determine localizaton
        $locale             = ($request->hasHeader('localization')) ? $request->header('localization') : 'en';
        $languageList       = Language::where('status', 'active')->get();

            if ($languageList->count() > 0) :
                foreach ($languageList as $lang) :
                    if($lang->code==$locale):
                        Config::set('app.locale', $locale);
                        return $next($request);
                    endif;
                endforeach;
            endif;

        // app()->setLocale($local);
        Config::set('app.locale', 'en');
        return $next($request);
    }
}
