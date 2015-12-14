@extends('main')
@section('content')
    <h1>重置密码</h1>
    {!! Form::open() !!}
    <div class="form-group">
        {!! Form::label('email','Email:') !!}
        {!! Form::email('email',  old('email'), ['class' => 'form-control', 'placeholder' => 'type your email']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password','Password:') !!}
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Input your password']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password_confirmation','Password_confirmation:') !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm the password']) !!}
    </div>
    {!! Form::submit('Reset Confirm', ['class'=>'btn btn-primary form-control']) !!}
    {!! Form::close() !!}

    @include('error')
@endsection