<?php

namespace Modules\User\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Sentinel;

class LoginCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (sentinel::check()) :
            return $next($request);

        else :
            if ($request->is('api/*')) :
                return response()->json(['error' => true, 'message' => 'Please Login', 'data' => ''], 401);
            endif;
            return redirect()->route('site.login.form');
        endif;
    }
}
