<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['only' => ['store', 'edit']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect( url ( 'user', 'comments'));
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
        $this->validate($request, [
            'content' => 'required'
        ]);
        $input  = $request->all();
        Comment::create(array_merge($input, ['user_id' => Auth::user()->id]));
        return redirect( url ('articles', $input['article_id']) );
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
        //检查用户是否有权限修改
        $comment = Comment::findOrFail($id);

        if(Gate::denies('updateOrDelete', $comment)) {
            abort(403, "你没有权限编辑该条评论");
        }


        return view('comment.edit', compact('comment'));
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
        $this->validate($request, [
            'content' => 'required'
        ]);
        Comment::find($id)->update($request->all()) ;
        return redirect(url('user', 'comments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if(Gate::denies('updateOrDelete', $comment)) {
            abort(403, "你没有权限删除该条评论");
        }

        if( $comment->delete() ) {
            return redirect(url('user', 'comments'));
        } else {
            $msg = 'Delete Failed';
            return view('errors.redirect', compact('msg'));
        }
    }
}
