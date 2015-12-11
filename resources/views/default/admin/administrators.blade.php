@extends('amazeui.main')

@section('content')
        <!-- content start -->
<div class="am-g">
    <div class="am-u-sm-12">
        <table class="am-table am-table-striped am-table-hover table-main">
            <thead>
            <tr>
                <th class="table-id">ID</th>
                <th class="table-title">用户名</th>
                <th>所属角色</th>
                <th class="table-date am-hide-sm-only">创建日期</th>
                <th class="table-set">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($all_admins as $one)
                <tr>
                    <td>{{ $one->id }}</td>
                    <td><a href="javascript:">{{ $one->username }}</a></td>
                    <td>
                        @foreach( $one->roles as $role)
                        <span class="am-badge am-badge-primary">{{ $role->role }}</span>
                        @endforeach
                    </td>
                    <td class="am-hide-sm-only">{{ $one->created_at }}</td>
                    <td>
                        <div class="am-btn-toolbar laravel-opera">
                            <div class="am-btn-group am-btn-group-xs">
                                <a class="am-btn am-btn-default am-btn-xs am-text-secondary  edit-one edit-true">
                                    <span class="am-icon-pencil-square-o"></span> 编辑
                                </a>
                                <input type="hidden" class="admin-id" value="{{ $one->id }}"/>
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
        {!! Form::open(['url'=> url('admin',['administrators','delete']), 'id' => 'admin_form']) !!}
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
        {!! Form::open(['url'=> url('admin',['administrators','edit']), 'id' => 'edit_form', 'class'=> 'am-form am-modal-dialog am-form-horizontal']) !!}
        <fieldset>
            <h5>&nbsp;</h5>
            <div class="am-form-group">
                {!! Form::label('username', "用户名", ['class' => 'am-u-sm-3']) !!}
                <div class="am-u-sm-9">
                    {!! Form::text('username', null, ['required' => 'required']) !!}
                </div>
            </div>
            <div class="am-form-group">
                {!! Form::label('password', "密码", ['class' => 'am-u-sm-3']) !!}
                <div class="am-u-sm-9">
                    {!! Form::password('password', ['required' => 'required']) !!}
                </div>
            </div>
            <div class="am-form-group">
                {!! Form::label('password_confirmation', "确认密码", ['class' => 'am-u-sm-3']) !!}
                <div class="am-u-sm-9">
                    {!! Form::password('password_confirmation', ['required' => 'required']) !!}
                </div>
            </div>
            <div class="am-form-group">
                {!! Form::label('role', "所属分组", ['class' => 'am-u-sm-3']) !!}
                <div class="am-u-sm-9">

                    @foreach($all_roles as $one_role)
                        <label class="am-checkbox-inline">
                            <input type="checkbox" value="{{ $one_role->id }}"  data-am-ucheck
                                   data-accept="@foreach($one_role->admins as $admin)|{{ $admin->id }}|@endforeach">
                            {{ $one_role->role }}{{ $one_role->id }}
                        </label>
                    @endforeach
                </div>
            </div>
            {!! Form::hidden('id') !!}
            {!! Form::hidden('roles') !!}
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
                        $("#admin_form").submit();
                    }
                });
            });

            $('.edit-one').on('click', function() {
                var $link = $(this);
                if($link.hasClass('edit-true')) { //编辑
                    $("#username")
                            .val($link.parents("tr").find("td").eq(1).find('a').html())
                            .attr('disabled', true);

                    var $admin_id = $link.siblings('.admin-id').val();
                    $("input[name='id']").val($admin_id);

                    //操作checkbox
                    $("#edit_form").find('input[type="checkbox"]').each(function () {

                        if($(this).data('accept').indexOf($admin_id) > -1) {
                            $(this).prop('checked', true);
                        }else{
                            $(this).prop('checked', false);
                        }
                    });


                } else if ($link.hasClass('add-true')) {
                    $("#username").attr('disabled', false).val('');
                    $("#password").val('');
                    $("#password_confirmation").val('')
                    $('input[type="checkbox"]').prop('checked', false);
                }

                $('#edit_form_modal').modal();
            });

            $(".submit-btn").on('click', function() {
                if(! $("input[name='username']").val()) {
                    alert('请填写字段内容');
                    return;
                }

                if( ($("input[name='password']").val() || $("input[name='password_confirmation']").val()) &&
                        ($("input[name='password']").val() != $("input[name='password_confirmation']").val()) ) {
                    alert('两次输入密码不一致');
                    return;
                }

                if( $("input[type='checkbox']:checked").length == 0) {
                    alert('请选择用户所属角色');
                    return;
                }

                $("#edit_form").find('input[type="checkbox"]').each(function () {

                    if($(this).prop('checked')) {
                        $('input[name="roles"]').val($('input[name="roles"]').val()+','+$(this).val());
                    }
                });

                $("#edit_form").submit();
            })
        });
    </script>
</div>
<!-- content end -->
@endsection