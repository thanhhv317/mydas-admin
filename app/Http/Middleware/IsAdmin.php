<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        if(!session()->has('user_data')['level'] || session()->has('user_data')['level'] > 1){
            return redirect()->back()->with("error", '701')->withInput($request->input());
        }
        return $next($request);
    }
}
