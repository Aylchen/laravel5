<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    protected $user_info;

    public function __construct ()
    { //访问后台必须登录

    }

    public function index ()
    {
        $user = Admin::user();

        foreach ($user->roles as $role) {
            $permissions = $role->permissions;

            foreach($permissions as $permission) {
                var_dump($permission->permission_name);
            }
        }








        return view('admin.index');
    }

















    public function login ()
    {
        if( session(config('app.admin_session'))) {
            return redirect('/admin');
        }

        return view('admin.login');
    }

    public function doLogin( Request $request)
    {

        if(empty($request->input('username'))) {

            $error_msg = "用户名不能为空";

        } else if( empty( $request->input('password'))) {

            $error_msg = "密码不能为空";

        } else {

            $admin = Admin::where('username', $request->input('username'))->first();

            if( $admin ) {

                if( $admin->password === md5($request->input('password'))) {

                    session([ config('app.admin_session') => $admin->username]);

                    return redirect('/admin');
                } else {

                    $error_msg = "用户名和密码不匹配";

                }

            }else {
                $error_msg = "用户不存在";
            }
        }

        return view('admin.login', compact('error_msg'));
    }

    public function doLogout ( )
    {
        session([ config('app.admin_session') => null ]);
        cookie( 'user_info', null );
        return redirect('/admin');
    }
}
