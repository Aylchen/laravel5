<?php

use Illuminate\Database\Seeder;

class InsertPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Permission::create(
           /* array(
                'permission' => 'admin/roles',
                'permission_name' => '角色管理'
            ),*/
           /* array (
                'permission' => 'admin/administrators',
                'permission_name' => '后台用户管理'
            ),*/
            /*array (
                'permission' => 'admin/users',
                'permission_name' => '用户管理'
            ),*/
            /*array (
                'permission' => 'admin/articles',
                'permission_name' => '文章管理'
            ),*/
            /*array (
                'permission' => 'admin/comments',
                'permission_name' => '评论管理'
            ),*/
            array (
                'permission' => 'admin/permissions/delete',
                'permission_name' => '权限删除'
            )
        );
    }
}
