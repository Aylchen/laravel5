<?php

namespace App\Http\Controllers;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public $pageCount = 10;
    public function __construct()
    {   // Auth all except index and show Article
        $this->middleware('auth',['except' => ['index','show']]);
        view()->share('highlight', true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $title    = 'Article Lists';

        $data     = $request->all();

        $key      = null;

        if(! empty($data['key'])) {
            $key  = $data['key'];
            $articles = Article::where('title','like', '%'.$data['key'].'%')->latest()->paginate($this->pageCount);
        } else {
            $articles =  Article::latest()-> paginate($this->pageCount);
        }

        $search_url = url('articles', 'index');
        return view('article.index', compact('articles', 'title', 'key', 'search_url'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.publish');
    }

    /**
     * Store a newly created resource in storage.
     * Validation Method 1
     * @param Requests\ArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Requests\ArticleRequest $request)
    {
        /*
         * use the request defined by the developer,
         * the same as the $this->validate($request, $rules = array() )
         */

        Article::create(array_merge(['user_id'=>Auth::user()->id], $request->all()));

        return redirect('/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article  = Article::findOrFail($id);

        /*
         * if use the pagination for the comments block, should get the comments collection like this:
         * Comment::where('article_id', '=', $id)->latest()->paginate($pageCount);
         * and then add {!! $comments->render() !!} in the template, but the best method I think is the
         * ajax pagination, but don't know how to do
         */

        $comments = $article->comments;
        $prev_id  = $this->getPrevArticleId($id);
        $next_id  = $this->getNextArticleId($id);
        return view('article.show', compact('article', 'comments', 'prev_id', 'next_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find( $id );

        //use the 'edit_article' ability that defined in AuthServiceProvider

        if(Gate::denies( 'update_delete_article', $article)) {

           // abort(403, "You don't have the permission for the current operation");

            return back()->withErrors("Permission denied");

        }

        return view('article.edit', compact('article'));
    }

    /**
     * @param Requests\ArticleRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Requests\ArticleRequest $request, $id)
    {
        Article::find($id)->update($request->all());

        return redirect( url( 'articles', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if(Gate::denies( 'update_delete_article', $article)) {
            return back()->withErrors("Permission denied");
        }

        /*
         * use $this->authorize can also check the ability of the current user,
         * Usage: $this->authorize('update_delete_article', $article);
         */

        if( Article::where("id",$id)->delete() ) {

            Comment::where("article_id", $id)->delete();

            return redirect('articles');
        }
    }

    public function getPrevArticleId ($id)
    {
        return Article::where('id', '<', $id)->max('id');
    }

    public function getNextArticleId ($id)
    {
        return Article::where('id', '>', $id)->min('id');
    }

}
