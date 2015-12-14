@extends('main')
@section('content')
    <h1 class="text-left">{{ $title }}&nbsp;&nbsp;<a href="/articles/create" class="btn btn-info">新增文章</a></h1>
    @include('search', true)
    <hr/>
    <ul class="list-group">
        @forelse($articles as $article)
        <li class="list-group-item">
            <p>Title: <a href="{{ url('articles', $article->id) }}">{{ $article->title }}</a></p>
            <p>Content: {{ str_limit($article->content, 50) }}</p>
            <p>Author: {{ App\User::find($article->user_id)->username }}</p>
        </li>
        @empty
            <li class="list-group-item">暂无文章</li>
        @endforelse
    </ul>
    {!! $articles->render() !!}
@endsection

{{--
    Public template can be used like this
    @include('common', true)
--}}
