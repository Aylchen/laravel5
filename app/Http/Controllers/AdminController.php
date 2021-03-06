<?php

namespace App\Http\Controllers;

use App\Admin;
use App\AdminRole;
use App\Comment;
use App\Permission;
use App\PermissionRole;
use App\Role;
use App\User;
use App\Article;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
    /**
     *  $with_add is for the adding function
     *  if $with_add is true, there should have a add-button for the current action-template
     */
    public function __construct () { }

    public function index ()
    {
        return view('admin.index');
    }

    private function _get_permissions ()
    {
        // order the permission for page show, this is not necessary
        $all             = Permission::all();
        $all_permissions = array();
        foreach($all as $key => $one) {
            if(strpos($one->permission, '/') === false) {
                $all_permissions[$one->permission][] = $one;
                continue;
            }
            $temp  =  explode('/', $one->permission);
            $all_permissions[$temp[1]][] =   $one;
        }

        return $all_permissions;
    }

    public function permissions ()
    {
        $all_permissions = $this->_get_permissions();

        $with_add        = true;

        $current_form    = 'permissions';

        return view('admin.permissions', compact('all_permissions', 'with_add', 'current_form'));
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

        //check repeat before operate the database
        $error_msg_route      = 'This route has already existed!';
        $error_msg_route_name = 'This route name has already existed!';
        if(! $request->input('id')) {

            if( Permission::where('permission', $request->input('permission'))->first() ) {
                return redirect()->back()->withErrors($error_msg_route);
            }

            if( Permission::where('permission_name', $request->input('permission_name'))->first() ) {
                return redirect()->back()->withErrors($error_msg_route_name);
            }

            $lastInsert = Permission::create($request->all());
            PermissionRole::create(array(
               'permission_id' => $lastInsert->id,
                'role_id'      => 1
            ));
        } else {

            $self = Permission::find($request->input('id'));

            if( ($self->permission != $request->input('permission')) &&
                 Permission::where('permission', $request->input('permission'))->first() ) {
                return redirect()->back()->withErrors($error_msg_route);
            }

            if( ($self->permission_name != $request->input('permission_name')) &&
                Permission::where('permission_name', $request->input('permission_name'))->first() ) {
                return redirect()->back()->withErrors($error_msg_route_name);
            }

            Permission::find($request->input('id'))->update($request->all());
        }

        return redirect()->back();
    }

    public function roles()
    {
        $all_roles = Role::all();

        $all_permissions = $this->_get_permissions();

        $with_add        = true;

        $current_form    = 'roles';

        return view('admin.roles', compact('all_roles', 'with_add', 'all_permissions', 'current_form'));
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

        $permissions    = array_filter(explode(',', $request->input('permissions')));

        $error_msg_role = 'The role has already existed!';
        if(! $request->input('id')) {

            if(Role::where('role', $request->input('role'))->first() ) {
                return redirect()->back()->withErrors($error_msg_role);
            }

            $lastInsert = Role::create($request->all());

            $insertRoleId =  $lastInsert->id;

        } else {

            $self = Role::find($request->input('id')) ;
            if( ($self->role != $request->input('role')) &&
                Role::where('role', $request->input('role'))->first() ) {
                return redirect()->back()->withErrors($error_msg_role);
            }

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
        $all_admins      = Admin::all();

        $all_roles       = Role::all();

        $with_add        = true;

        $current_form    = 'administrators';

        return view('admin.administrators', compact('all_admins','with_add', 'all_roles', 'current_form'));
    }

    public function administrator_delete(Request $request)
    {

        Admin::where("id", $request->input('delete_id'))->delete();

        return redirect()->back();
    }

    public function administrator_edit(Request $request)
    {
        $roles = array_filter(explode(',', $request->input('roles')));

        if(! $request->input('id')) {

            //check if the username has already exists
            if( Admin::where('username', $request->input('username'))->first() ) {
                return redirect()->back()->withErrors('The username has already existed!');
            }

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
        $all_users = User::all();
        $current_form = 'users';
        return view('admin.users', compact('all_users', 'current_form'));
    }

    public function user_delete(Request $request)
    {
        User::where("id", $request->input('delete_id'))->delete();

        Article::where("user_id", $request->input('delete_id'))->delete();

        Comment::where("user_id", $request->input('delete_id'))->delete();

        return redirect()->back();
    }

    public function articles()
    {
        $all_articles = Article::latest()-> paginate(10);
        $current_form = 'articles';
        return view('admin.articles', compact('all_articles', 'current_form'));
    }

    public function article_delete(Request $request)
    {
        Article::where("id", $request->input('delete_id'))->delete();
        //at the same time, delete all the comments of the articles
        Comment::where("article_id", $request->input('delete_id'))->delete();
        return redirect()->back();
    }

    public function comments()
    {
        $all_comments  = Comment::latest()->paginate(20);

        $current_form = 'comments';

        return view('admin.comments', compact('all_comments', 'current_form'));
    }

    public function comment_delete(Request $request)
    {
        Comment::where('id', $request->input('delete_id'))->delete();

        return redirect()->back();
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

            $error_msg = "The username field can't be blank";

        } else if( empty( $request->input('password'))) {

            $error_msg = "The password field can't be blank";

        } else {

            $admin = Admin::where('username', $request->input('username'))->first();

            if( $admin ) {

                if( $admin->password === md5($request->input('password'))) {

                    session([ config('app.admin_session') => $admin->username]);

                    return redirect('/admin');
                } else {

                    $error_msg = "The user doesn't match the password";

                }

            }else {
                $error_msg = "The username doesn't exist";
            }
        }

        return redirect()->back()->withErrors($error_msg);
    }

    public function doLogout ( )
    {
        session([ config('app.admin_session') => null ]);
        return redirect('/admin');
    }

}
