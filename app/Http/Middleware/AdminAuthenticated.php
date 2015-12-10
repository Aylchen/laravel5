<?php

namespace App\Http\Middleware;

use Closure;
use App;

class AdminAuthenticated
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
//此处判断权限，在此之前需要先搞定多用户表身份认证的问题

  /*      config('auth.model') =  App\Admin::class;

        config('auth.table') = 'admins';*/

        return $next($request);
    }
}
