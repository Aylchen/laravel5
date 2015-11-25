@extends('main')

@section('content')
    <h1>登录</h1>
    {!! Form::open(['url' => '/auth/login']) !!}
    <div class="form-group">
        {!! Form::label('username','UserName:') !!}
        {!! Form::text('username', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password','Password:') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>

    {!! Form::submit('Submit', ['class'=>'btn btn-primary form-control']) !!}

    {!! Form::close() !!}
@stop


