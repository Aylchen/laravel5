@extends('amazeui.main')

@section('content_table')
    <table class="am-table am-table-striped am-table-hover table-main">
        <thead>
        <tr><th colspan="10"> @include('error')</th> </tr>
        <tr>
            <th>ID</th>
            <th>文章标题</th>
            <th style="width:45%;">文章内容</th>
            <th>创建日期</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($all_articles as $one)
            <tr>
                <td>{{ $one->id }}</td>
                <td><a href="{{ url('articles', $one->id) }}" target="_blank">{{ $one->title }}</a></td>
                <td>{{ str_limit($one->content, 50) }} </td>
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
    <div class="pull-right"> {!! $all_articles->render() !!}  </div>
@endsection