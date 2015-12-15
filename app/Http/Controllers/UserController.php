<?php

namespace App\Http\Controllers;
use App\Article;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public $pageCount = 10;
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }


    public function profile()
    {
        return view('user.profile');
    }


    public function comments()
    {
        $comments = Comment::where('user_id', '=', Auth::user()->id)->latest()->paginate($this->pageCount);

        return view('user.comments', compact('comments'));
    }

    public function articles(Request $request)
    {
        $title    = 'My Articles';

        $data     = $request->all();

        $key      = null;

        if(! empty($data['key'])) {
            $key  = $data['key'];
            $articles = Article::where('user_id', '=', Auth::user()->id)->where('title','like', '%'.$data['key'].'%')->latest()->paginate($this->pageCount);
        } else {
            $articles =  Article::where('user_id', '=', Auth::user()->id)->latest()-> paginate($this->pageCount);
        }

        $search_url = url('user', 'articles');
        return view('article.index', compact('articles', 'title', 'key', 'search_url'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
