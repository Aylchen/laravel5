<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    protected $fillable = ['permission'];

    public function roles(){

        return $this->belongsToMany( 'App\Role' );

    }
}
