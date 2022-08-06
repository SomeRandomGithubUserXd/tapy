<?php

namespace App\Http\Middleware;

use App\Models\Page\Page;
use Closure;
use Illuminate\Http\Request;

class UserOwnsPageElementMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $pageElement = $request->route()->parameter('page_element');
        abort_if(Page::where(['user_id' => auth()->id(), 'id' => $pageElement->page_id])->doesntExist(), 401);
        return $next($request);
    }
}
