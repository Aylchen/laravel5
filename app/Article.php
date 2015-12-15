<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $table = "articles";

    protected $fillable = ['title', 'content', 'user_id'] ;

    protected function user()
    {
        return $this->belongsTo('App\User');
    }

    protected function comments() {
        //article_id： foreign_key; id: local_key
        return $this->hasMany('App\Comment', 'article_id', 'id')->orderBy('updated_at', 'desc');
    }
}
