@extends('main')
@section('content')
    <h1>登录</h1>
    {!! Form::open() !!}
    <div class="form-group">
        {!! Form::label('username ','Username:') !!}
        {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Input The Username']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password','Password:') !!}
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Input The password']) !!}
    </div>
    <p>
        <a href="{{ url('auth', 'register') }}">Sign Up</a>
        <a href="{{ url('password', 'email') }}" class="pull-right">Reset password</a>
    </p>
    {!! Form::submit('Sign In', ['class'=>'btn btn-primary form-control']) !!}
    {!! Form::close() !!}

    @include('error')
@endsection
