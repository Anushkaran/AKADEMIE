<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UnActiveAccountMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()->isActive())
        {
            return  $next($request);
        }

        return redirect()->back();

    }
}
