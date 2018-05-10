<?php

namespace App\Http\Middleware;

use Closure;

class CheckEmployeeSession
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
        if(!session()->has('staffId') || session()->get('role') == 'admin'){
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}
