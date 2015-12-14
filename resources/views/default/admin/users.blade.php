@extends('amazeui.main')

@section('content_table')
    <table class="am-table am-table-striped am-table-hover table-main">
        <thead>
        <tr><th colspan="10"> @include('error')</th> </tr>
        <tr>
            <th class="table-id">ID</th>
            <th class="table-title">用户名</th>
            <th style="width:45%;">邮箱</th>
            <th class="table-date am-hide-sm-only">创建日期</th>
            <th class="table-set">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($all_users as $one)
            <tr>
                <td>{{ $one->id }}</td>
                <td><a href="javascript:">{{ $one->username }}</a></td>
                <td>{{ $one->email }} </td>
                <td class="am-hide-sm-only">{{ $one->created_at }}</td>
                <td>
                    <div class="am-btn-toolbar laravel-opera">
                        <div class="am-btn-group am-btn-group-xs">
                            <input type="hidden" class="role-id" value="{{ $one->id }}"/>
                            <a href="#" data-id="{{ $one->id }}" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only  btn-delete">
                                <span class="am-icon-trash-o"></span> 删除
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection