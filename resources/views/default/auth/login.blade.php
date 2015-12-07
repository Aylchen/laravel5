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

    <a href="/auth/register">Sign Up</a>
    {!! Form::submit('Sign In', ['class'=>'btn btn-primary form-control']) !!}
    {!! Form::close() !!}

    @include('error')
@endsection

{{--
@section('sidebar')
    @parent
    Add New SideBar
@endsection--}}
