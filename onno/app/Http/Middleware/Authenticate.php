<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) :
            if ($request->is('api/*')) :
                return response()->json(['error' => true, 'message' => 'Please Login', 'data' => ''],401);
            endif;

            return route('login');
        endif;
    }
}
