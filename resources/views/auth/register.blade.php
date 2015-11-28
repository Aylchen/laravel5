@extends('main')
@section('content')
    <h1>注册</h1>
    {!! Form::open(['url' => '/auth/register']) !!}
    <div class="form-group">
        {!! Form::label('username','UserName:') !!}
        {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Input your username']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email','Email:') !!}
        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Input your email']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password','Password:') !!}
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Input your password']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password_confirmation','Password_confirmation:') !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm the password']) !!}
    </div>
    <a href="/auth/login">Sign In</a>
    {!! Form::submit('Sign Up', ['class'=>'btn btn-primary form-control']) !!}

    {!! Form::close() !!}

    @include('error')
    @endsection