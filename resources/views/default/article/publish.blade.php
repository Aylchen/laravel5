@extends('main')

@section('content')
    <h1>文章发表</h1>
    {!! Form::open(['url' => 'articles']) !!}
    @include('article.article_form')
    {!! Form::close() !!}
    @include('error')
@endsection


