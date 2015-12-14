@extends('main')
@section('content')
    <h1>重置密码</h1>
    {!! Form::open(['url' => url('password', 'email')]) !!}
    <div class="form-group">
        {!! Form::label('email','Email:') !!}
        {!! Form::email('email',  old('email'), ['class' => 'form-control', 'placeholder' => 'type your email']) !!}
    </div>

    {!! Form::submit('Send Password Reset Link', ['class'=>'btn btn-primary form-control']) !!}
    {!! Form::close() !!}

    @include('error')
@endsection