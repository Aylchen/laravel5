@extends('main')

@section('content')
    <Article>
        <div class="pull-left">
            <a href="javascript:history.back();"> <<&nbsp;返回 </a>
        </div>
        <div class="pull-right">
            <a href="/articles/{{ $article->id }}/edit" class="btn btn-primary">Edit</a>
            <a href="/articles/{{ $article->id }}/delete" class="btn btn-danger">Delete</a>
        </div>
        <div class="page-header">
            <h3>{{ $article->title }}</h3>
        </div>
        <p>{{ $article->content }}</p>

    </Article>
@endsection


