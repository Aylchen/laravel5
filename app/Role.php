<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = ['role'];

    protected function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }

    protected function admins()
    {
        return $this->belongsToMany('App\Admin');
    }
}
