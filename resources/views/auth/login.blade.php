@extends('main')
@section('content')
    <h1>登录</h1>
    {!! Form::open() !!}
    {{--<div class="form-group">
        {!! Form::label('username','UserName:') !!}
        {!! Form::text('username', null, ['class' => 'form-control']) !!}
    </div>--}}
    <div class="form-group">
        {!! Form::label('username ','username:') !!}
        {!! Form::text('username', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password','Password:') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>
    <a href="/auth/register">Regist</a>
    {!! Form::submit('Submit', ['class'=>'btn btn-primary form-control']) !!}

    {!! Form::close() !!}

    @include('error')
@endsection

{{--
@section('sidebar')
    @parent
    Add New SideBar
@endsection--}}
