@extends('amazeui.main')

@section('content')
        <!-- content start -->
<div class="am-g">
    <div class="am-u-sm-12">
            <table class="am-table am-table-striped am-table-hover table-main">
                <thead>
                <tr>
                    <th class="table-id">ID</th>
                    <th class="table-title">权限名称</th>
                    <th class="table-type">相应路由</th>
                    <th class="table-date am-hide-sm-only">创建日期</th>
                    <th class="table-set">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all_permissions as $one)
                    <tr>
                        <td>{{ $one->id }}</td>
                        <td><a href="javascript:">{{ $one->permission_name }}</a></td>
                        <td>{{ $one->permission }}</td>
                        <td class="am-hide-sm-only">{{ $one->created_at }}</td>
                        <td>
                            <div class="am-btn-toolbar laravel-opera">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a class="am-btn am-btn-default am-btn-xs am-text-secondary  edit-one edit-true">
                                        <span class="am-icon-pencil-square-o"></span> 编辑
                                    </a>
                                    <input type="hidden" class="permission-show" value="{{ $one->is_show }}"/>
                                    <input type="hidden" class="permission-id" value="{{ $one->id }}"/>
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
            {!! Form::open(['url'=> url('admin',['permissions','delete']), 'id' => 'permission_form']) !!}
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

    <div class="am-modal am-modal-confirm" tabindex="-1" id="edit_form_modal">
        {!! Form::open(['url'=> url('admin',['permissions','edit']), 'id' => 'edit_form', 'class'=> 'am-form am-modal-dialog am-form-horizontal']) !!}
        <fieldset>
            <h5>&nbsp;</h5>
            <div class="am-form-group">
                {!! Form::label('permission', "权限路由", ['class' => 'am-u-sm-3']) !!}
                <div class="am-u-sm-9">
                    {!! Form::text('permission', null, ['required' => 'required']) !!}
                </div>
            </div>
            <div class="am-form-group">
                {!! Form::label('permission_name', "权限名称", ['class' => 'am-u-sm-3']) !!}
                <div class="am-u-sm-9">
                    {!! Form::text('permission_name', null, ['required' => 'required']) !!}
                </div>
            </div>

            <div class="am-form-group">
                {!! Form::label('is_show', "是否作为菜单显示", ['class' => 'am-u-sm-3']) !!}
                <div class="am-u-sm-9">
                    {!! Form::select('is_show', array('否', '是')) !!}
                </div>
            </div>
            {!! Form::hidden('id') !!}

            <div class="am-form-group am-modal-footer">
                <span class="am-modal-btn am-btn am-btn-default" data-am-modal-cancel>取消</span>
                <span class="am-btn submit-btn am-btn-primary">确定</span>
            </div>


        </fieldset>
        {!! Form::close() !!}
        @include('error')
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
                        $("#permission_form").submit();
                    }
                });
            });

            $('.edit-one').on('click', function() {
                var $link = $(this);
                if($link.hasClass('edit-true')) { //编辑
                    $("#permission").val($link.parents("tr").find("td").eq(2).html());
                    $("#permission_name").val($link.parents("tr").find("td").eq(1).find('a').html());
                    $("#is_show").val($link.siblings('.permission-show').val());
                    $("input[name='id']").val($link.siblings('.permission-id').val());

                } else if ($link.hasClass('add-true')) {
                    $("#edit_form").find('input[name!="_token"]').val('');
                }

                $('#edit_form_modal').modal();
            });

            $(".submit-btn").on('click', function() {
                if(! $("input[name='permission']").val() || !$("input[name='permission_name']").val() ) {
                    alert('请填写字段内容');
                    return;
                }

                $("#edit_form").submit();
            })
        });
    </script>
</div>
<!-- content end -->
@endsection