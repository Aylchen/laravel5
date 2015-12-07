@extends('main')

@section('content')

    {!! Form::model($comment, ['method' => 'PATCH', 'url'=>url('user',['comments', $comment->id])]) !!}
    <div class="form-group">
        {!! Form::label('content','发表评论') !!}
        {!! Form::textarea('content', null, ['rows' => 3, 'class' => 'form-control', 'placeholder' => 'Say Something...']) !!}
    </div>
    {!! Form::submit('提交评论', ['class'=>'btn btn-primary form-control']) !!}
    {!! Form::close() !!}
    @include('error')

@endsection