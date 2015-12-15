<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Route;
use App\Admin;

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

        //step1 check if the administrator has logged in

        if(! session(config('app.admin_session'))) {
            return redirect( url('admin', 'login') );
        }

        //step2 check the permissions of the current admin
        $nav            = "";
        $current_route  = collect(Route::getCurrentRoute())->first();

        $permissions    = array() ; // to generate the sidebar menus
        $my_permissions = array();  // all the permissions that the current admin has
        $temp           = array();  // filter the possible repeat menu

        $user           = Admin::user();
        if( $user ) {

            foreach ($user->roles as $role) {

                $permissions_all = $role->permissions;

                foreach($permissions_all as $key => $permission) {

                    if( $current_route == $permission->permission ) {
                        $nav = $permission->permission_name;
                    }

                    /*
                     *  to get sidebar menus by is_show column,
                     *  if is_show == 1, the menu shows
                     */

                    if( $permission->is_show == 1) {
                        if(in_array($permission->permission_name, $temp)) {
                            /*
                             * if a user has multi roles, and these roles has cross permissions, to avoid
                             * a repeated menu
                             * $temp array is for this
                             */
                            continue;
                        }
                        $permissions[] =
                            array(
                                'url' => substr($permission->permission,6),
                                'permission_name' => $permission->permission_name
                            );
                        $temp[] = $permission->permission_name;
                    }

                    $my_permissions[] = $permission->permission ;
                }
            }
        }

        // array_unique used just like $temp array

        if(! in_array( $current_route, array_unique($my_permissions))) {
            return redirect()->back()->withErrors("Permission Denied！！！");
        }

        view()->share('nav', $nav);
        view()->share('permissions', $permissions);

        return $next($request);
    }
}
