@extends('main')

@section('content')
    <h1>文章发表</h1>
    {!! Form::open(['url' => '/publish']) !!}
    {{--    @if(!is_null($results))
        {{ $results->name }}
        @endif--}}

    <div class="form-group">
        {!! Form::label('title','Title:') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('content','Content:') !!}
        {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
    </div>

    {!! Form::submit('Submit', ['class'=>'btn btn-primary form-control']) !!}

    {!! Form::close() !!}
@stop


