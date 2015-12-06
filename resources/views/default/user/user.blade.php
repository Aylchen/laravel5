@extends('main')

@section('content')
    <h1>All Users:{!! Auth::user()->username !!}</h1>
    <ul class="list-group">
        @foreach($users as $user)
        <li class="list-item">
            UserName:{!! $user->username !!}
            Email:   {!! $user->email !!}
        </li>
        @endforeach
    </ul>

@endsection
