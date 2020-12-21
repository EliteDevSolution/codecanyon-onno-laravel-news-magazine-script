<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException):
                return response()->json(['error' => true, 'message' => 'Token is Invalid', 'data' => ''],401);
            elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException):
                return response()->json(['error' => true, 'message' => 'Token is Expired', 'data' => ''],401);
            else:
                return response()->json(['error' => true, 'message' => 'Authorization Token not found', 'data' => ''],401);
            endif;
        }
        return $next($request);

    }
}
