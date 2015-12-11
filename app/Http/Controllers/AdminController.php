<?php

namespace App\Http\Controllers;

use App\Admin;
use App\AdminRole;
use App\Permission;
use App\PermissionRole;
use App\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{


    public function __construct ()
    {
        //用户登录后通过关联模型获取到当前用户的权限列表
        //使用视图共享数据来向视图assign数据

    }

    public function index ()
    {
        return view('admin.index');
    }

    public function permissions ()
    {
        $all_permissions = Permission::all();

        $with_add        = true;

        return view('admin.permissions', compact('all_permissions', 'with_add'));
    }

    public function permission_delete(Request $request)
    {

        Permission::where("id", $request->input('delete_id'))->delete();

        return redirect()->back();
    }

    public function permission_edit(Request $request)
    {
        $this->validate($request, array(
            'permission' => 'required',
            'permission_name' => 'required'
        ));
        //根据$request->input('id')判断是create还是update

        if(! $request->input('id')) {
            $lastInsert = Permission::create($request->all());
            PermissionRole::create(array(
               'permission_id' => $lastInsert->id,
                'role_id'      => 1
            ));
        } else {
            Permission::find($request->input('id'))->update($request->all());
        }

        return redirect()->back();
    }

    public function roles()
    {
        $all_roles = Role::all();

        $all_permissions = Permission::all();

        $with_add        = true;

        return view('admin.roles', compact('all_roles', 'with_add', 'all_permissions'));
    }

    public function role_delete(Request $request)
    {

        Role::where("id", $request->input('delete_id'))->delete();

        return redirect()->back();
    }

    public function role_edit(Request $request)
    {


        $this->validate($request, array(
            'role' => 'required'
        ));

        $permissions = array_filter(explode(',', $request->input('permissions')));

        if(! $request->input('id')) {
            $lastInsert = Role::create($request->all());

            $insertRoleId =  $lastInsert->id;

        } else {

            $insertRoleId = $request->input('id');

            Role::find($insertRoleId)->update($request->all());

            PermissionRole::where('role_id', $insertRoleId)->delete();

        }

        foreach($permissions as $one) {

            PermissionRole::create(
                array(
                    'permission_id' => $one,
                    'role_id'       => $insertRoleId
                )
            );
        }

        return redirect()->back();
    }


    public function administrators()
    {
        $all_admins = Admin::all();

        $all_roles  = Role::all();

        $with_add        = true;

        return view('admin.administrators', compact('all_admins','with_add', 'all_roles'));
    }

    public function administrator_delete(Request $request)
    {

        Admin::where("id", $request->input('delete_id'))->delete();

        return redirect()->back();
    }

    public function administrator_edit(Request $request)
    {

        $this->validate($request, array('username'=>'required'));
        $roles = array_filter(explode(',', $request->input('roles')));

        if(! $request->input('id')) {

            $lastInsert = Admin::create(
                array(
                    'username' => $request->input('username'),
                    'password' => md5($request->input('password'))
                )
            );

            $insertAdminId =  $lastInsert->id;

        } else {

            $insertAdminId = $request->input('id');

            if($request->input('password')) {

                Admin::where('id', $insertAdminId)->update(['password' => md5($request->input('password'))]);

            }

            AdminRole::where('admin_id', $insertAdminId)->delete();

        }

        foreach($roles as $one) {

            AdminRole::create(
                array(
                    'admin_id' => $insertAdminId,
                    'role_id'  => $one
                )
            );
        }

        return redirect()->back();
    }

    public function users()
    {
        return view('admin.index');
    }

    public function articles()
    {
        return view('admin.index');
    }

    public function comments()
    {
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
