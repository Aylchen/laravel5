<?php

namespace App\Providers;

use App\Comment;
use App\Policies\CommentPolicy;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Comment::class => CommentPolicy::class //'App\Comment' => 'App\Policies\CommentPolicy'
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

        /**
         * If an user want to modify or delete an article, he must be the article's author || the same as comments
         */
        $gate->define('update_delete_article', function( $user, $article) {

            return $user->id === $article->user_id;

        });

    //    $gate->before(function () {echo "before Authorization<br/>";});

       // $gate->define('show_article', 'ArticleController@index');

    }
}
