<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    protected $fillable = ['permission', 'permission_name', 'is_show'];

    public function roles(){

        return $this->belongsToMany( 'App\Role' );

    }

}
