<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserIsNotBlockedMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        abort_if($request->user()->is_blocked, 401);
        return $next($request);
    }
}
