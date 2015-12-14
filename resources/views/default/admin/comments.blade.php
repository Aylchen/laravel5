@extends('amazeui.main')

@section('content_table')
    <table class="am-table am-table-striped am-table-hover table-main">
        <thead>
        <tr><th colspan="10"> @include('error')</th> </tr>
        <tr>
            <th class="table-id">ID</th>
            <th class="table-title">发表人</th>
            <th style="width:30%;">所属文章</th>
            <th style="width:45%;">评论内容</th>
            <th class="table-date am-hide-sm-only">创建日期</th>
            <th class="table-set">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($all_comments as $one)
            <tr>
                <td>{{ $one->id }}</td>
                <td><a href="javascript:">{{ $one->user->username }}</a></td>
                <td><a href="{{  url('articles', $one->article->id) }}" class="text-info" target="_blank"> {{ $one->article->title }} </a></td>
                <td>{{ $one->content }}</td>
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
    <div class="pull-right"> {!! $all_comments->render() !!}  </div>
@endsection