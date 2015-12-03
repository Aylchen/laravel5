@extends('main')
@section('content')
    <h1>文章列表&nbsp;&nbsp;
        <a href="/articles/create" class="btn btn-info">新增文章</a>
    </h1>
    <ul class="list-group">
        @foreach($articles as $article)
        <li class="list-group-item">
            <p>Title: <a href="{{ url('articles', $article->id) }}">{{ $article->title }}</a></p>
            <p>Content:{{ mb_substr($article->content, 0, 50) }}...</p>
            <p>Author: {{ App\User::find($article->user_id)->username }}</p>
        </li>
        @endforeach
    </ul>
    {!! $articles->render() !!}
@endsection
