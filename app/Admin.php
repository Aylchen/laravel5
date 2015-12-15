<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';

    protected $fillable = ['username', 'password'];

    protected $hidden   = ['password'];

    protected function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    protected static function user ()
    {

        if( session(config('app.admin_session')) ) {

            return  Admin::where('username', session( config('app.admin_session')  ))->first();

        } else {

            return false;

        }
    }

}
