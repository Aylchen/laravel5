<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        \App\Role::create(
            array (  'role' => '普通管理员'   )
        );

        \App\Permission::create(
            array ( 'permission' => 'admin/check')

        );
    }
}
