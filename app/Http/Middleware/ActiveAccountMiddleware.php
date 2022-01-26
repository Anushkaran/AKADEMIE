<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ActiveAccountMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()->isActive())
        {
            if ($request->is('partner*'))
            {
                return redirect()->to('partner/un-active/account');
            }

            if ($request->is('user*'))
            {
                return redirect()->to('user/un-active/account');
            }
        }
        return $next($request);
    }
}
