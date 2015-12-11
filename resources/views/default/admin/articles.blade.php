@extends('amazeui.main')

@section('content')
        <!-- content start -->
<div class="am-g">
    <div class="am-u-sm-12">
        <table class="am-table am-table-striped am-table-hover table-main">
            <thead>
            <tr>
                <th class="table-id">ID</th>
                <th class="table-title">文章标题</th>
                <th style="width:45%;">文章内容</th>
                <th class="table-date am-hide-sm-only">创建日期</th>
                <th class="table-set">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($all_articles as $one)
                <tr>
                    <td>{{ $one->id }}</td>
                    <td><a href="javascript:">{{ $one->title }}</a></td>
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
        {!! Form::open(['url'=> url('admin',['articles','delete']), 'id' => 'article_form']) !!}
        {!! Form::hidden('delete_id', null, ['id' => 'opera_id']) !!}
        {!! Form::close() !!}
    </div>

    <div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">
        <div class="am-modal-dialog">
            <div class="am-modal-bd">
                你确定要删除这条记录吗？
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>确定</span>
            </div>
        </div>
    </div>

    {{--</div>--}}
    <script>
        $(function() {
            $('.btn-delete').on('click', function() {
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function() {
                        var $link = $(this.relatedTarget);
                        $("#opera_id").val($link.data('id'));
                        $("#article_form").submit();
                    }
                });
            });
        });
    </script>
</div>
<!-- content end -->
@endsection