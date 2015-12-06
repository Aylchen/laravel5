<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $table = "articles";

    protected $fillable = ['title', 'content', 'user_id'] ;

    //set Field Attribute
   /* public function setPublishedAttribute()
    {
    //    $this->attributes['published'] = Carbon::now();
    }*/

    protected function users(){
        return $this->belongsTo('App\User');
    }

    protected function comments() {
        return $this->hasMany('App\Comment', 'article_id', 'id')->orderBy('updated_at', 'desc');//article_id： foreign_key; id: local_key
    }
}
