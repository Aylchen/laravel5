<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $table = "articles";

    protected $fillable = ['title', 'content', 'published'] ;

    //set Field Attribute
   /* public function setPublishedAttribute()
    {
    //    $this->attributes['published'] = Carbon::now();
    }*/

    protected function users(){
        return $this->belongsTo('App\User');
    }
}
