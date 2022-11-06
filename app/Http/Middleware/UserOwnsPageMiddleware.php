<?php

namespace App\Http\Middleware;

use App\Models\Page\Page;
use Closure;
use Illuminate\Http\Request;

class UserOwnsPageMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $page = $request->route()->parameter('page');
        abort_if($page->user_id !== auth()->id(), 401);
        return $next($request);
    }
}
