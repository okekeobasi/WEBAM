<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminSession
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
        if(!session()->has('staffId') || session()->get('role') == 'regular'){
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}
