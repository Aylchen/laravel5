<?php

namespace App\Http\Controllers;
use App\Comment;
use App\Http\Requests;
use App\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{

    public function __construct()
    { // Auth all except index and show Article
        $this->middleware('auth',['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles =  Article::latest()-> paginate(5);

        $title    = '文章列表';

        return view('article.index', compact('articles', 'title'));
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
        //使用Request 进行验证 ，request对象为自己创建的Request对象
        Article::create(array_merge(['user_id'=>Auth::user()->id], $request->all()));

        return redirect('/articles');
    }
    /**
     * Validation Method 2
     */
/*    public function store(Request $request)
    {
        $this->validate($request,['title' => 'required', 'content' => 'required']);
        ...
    }*/
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article  = Article::findOrFail($id);
        //如果要给comments添加分页，使用：//Comment::where('article_id', '=', $id)->latest()->paginate(20);在模板中{!! $comments->render() !!}
        $comments = $article->comments;
        $prev_id  = $this->getPrevArticleId($id);
        $next_id  = $this->getNextArticleId($id);
        return view('article.show', compact('article', 'comments', 'prev_id', 'next_id'));
    }

    public function gateShow()
    {
        echo "Here is a test message";
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

           // abort(403,'你没有权限执行当前edit操作');

            return back()->withErrors('你没有权限执行当前edit操作');

        }

        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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

            return back()->withErrors('你没有权限执行当前delete操作');

        }

    /*use $this->authorize can also check the ability of the current user, Usage:

        $this->authorize('update_delete_article', $article);*/

        if( Article::where("id",$id)->delete() ) {

            Comment::where("article_id", $id)->delete();

            return redirect('/articles');
        } else {
            $msg = 'Delete Failed';
            return view('errors.redirect', compact('msg'));
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
