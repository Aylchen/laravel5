<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       //insert data
/* DB::table('users')->insert( array(
                array( 'username' => 'test1', 'email'    => '1@163.com' ),
                array( 'username' => 'test2', 'email'    => '2@163.com' )
        ) );*/
        // update data
        //DB::table('users')->where('username','test2')->update(['email' => 'test2@163.com']);
        $users  = DB::table('users')->get();
     //   $users1 = DB::table('users')->lists('username');//just get username field
        return view('user.user',compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * test FirstOrCreate and FirstOrNew
     */
    public function test()
    {
        //if not exists , then create one and return the instance;
        $data = User::firstOrCreate(['username' => 'Aylchen']);
        //if no exists , create a new instance of this new record;
        $data2 = User::firstOrNew(['username' => 'AAA']);
        $data2->save();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
