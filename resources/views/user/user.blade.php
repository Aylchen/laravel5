@extends('main')

@section('content')
    <h1>All Users:{!! Auth::user()->username !!}</h1>
    ul.
    @foreach($users as $user)

    UserName:{!! $user->username !!}
    Email:   {!! $user->email !!}
    <br/>

    @endforeach


    @endsection
