@extends('main')

@section('content')

    <h1 class="text-left">我的信息</h1>
    <hr/>
    <div class="my-form-group">
        <label>用户名：</label>
        <div class="text-left">{{ Auth::user()->username }}</div>
    </div>
    <div class="my-form-group">
        <label>邮箱：</label>
        <div class="text-left">{{ Auth::user()->email }}</div>
    </div>
    <div class="my-form-group">
        <label>创建时间：</label>
        <div class="text-left">{{ Auth::user()->created_at }}</div>
    </div>
@endsection