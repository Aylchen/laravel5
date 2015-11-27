@extends('main')

@section('content')
    <h1>文章详情 </h1><a href="/articles/{{ $article->id }}/edit">Edit</a>

    <p>Title: {{ $article->title }}</p>
    <p>Content: {{ $article->content }}</p>

@endsection


