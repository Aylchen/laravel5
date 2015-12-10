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

        //step1 checkout if the administrator logged in

        if(! session(config('app.admin_session'))) {
            return redirect( url('admin', 'login') );
        }

        //判断权限


        return $next($request);
    }
}
