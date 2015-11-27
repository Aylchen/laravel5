<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Article;
use Illuminate\Support\Facades\Auth;

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
        return view('article.index', compact('articles'));
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
        $input = array_merge(['user_id'=>Auth::user()->id], $request->all());
        Article::create($input);
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
        $article = Article::findOrFail($id);
        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
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
        return redirect('/articles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
