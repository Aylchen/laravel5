@extends('main')

@section('content')
    <h1>文章列表&nbsp;&nbsp;<a href="/articles/create" style="font-size: 14px">新增文章</a></h1>
    <ul>
        @foreach($articles as $article)
        <li>
            <p>Title: <a href="{{ url('articles', $article->id) }}">{{ $article->title }}</a></p>
            <p>Content: {{ $article->content }}</p>
            <p>Author: {{ App\User::find($article->user_id)->username }}</p>
        </li>
        @endforeach
    </ul>
    {!! $articles->render() !!}
@endsection


