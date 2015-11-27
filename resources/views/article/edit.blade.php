@extends('main')

@section('content')
    <h1>文章编辑：{{ $article->title }}</h1>
    {!! Form::model($article, ['method' => 'PATCH', 'url' => '/articles/'.$article->id]) !!}
    @include('article.article_form')
    {!! Form::close() !!}
    @include('error')
@endsection


