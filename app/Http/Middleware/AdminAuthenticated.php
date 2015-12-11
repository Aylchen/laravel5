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

        //step1 checkout if the administrator has logged in

        if(! session(config('app.admin_session'))) {
            return redirect( url('admin', 'login') );
        }

        //step2 check the permissions of the current admin
        $nav            = "";
        $current_route  = collect(Route::getCurrentRoute())->first();

        $permissions    = array() ;
        $my_permissions = array();
        $temp           = array();

        $user           = Admin::user();
        if( $user ) {

            foreach ($user->roles as $role) {

                $permissions_all = $role->permissions;

                foreach($permissions_all as $key => $permission) {

                    if( $current_route == $permission->permission ) {
                        $nav = $permission->permission_name;
                    }
                    if( $permission->is_show == 1) { //通过is_show字段来取得左侧导航菜单 ==1显示
                        if(in_array($permission->permission_name, $temp)) {
                            //多角色用户如果权限重复,则去除
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

        //使用array_unique是因为多角色用户可能权限有重复

        if(! in_array( $current_route, array_unique($my_permissions))) {
            abort(403, "你没有权限执行当前操作");
        }

        view()->share('nav', $nav);
        view()->share('permissions', $permissions);

        return $next($request);
    }
}
