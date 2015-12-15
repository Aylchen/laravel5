@extends('amazeui.main')

@section('content_table')
    <table class="am-table am-table-striped am-table-hover table-main">
        <thead>
        <tr><th colspan="10"> @include('error')</th> </tr>
        <tr>
            <th>ID</th>
            <th>角色名称</th>
            <th style="width:45%;">权限列表</th>
            <th>创建日期</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($all_roles as $one)
            <tr>
                <td>{{ $one->id }}</td>
                <td><a href="javascript:">{{ $one->role }}</a></td>
                <td>

                    @foreach($one->permissions as $per)
                        <span class="am-badge am-badge-secondary" data-permission="{{$per->id}}">{{ $per->permission_name }}</span>
                    @endforeach

                </td>
                <td class="am-hide-sm-only">{{ $one->created_at }}</td>
                <td>
                    <div class="am-btn-toolbar laravel-opera">
                        <div class="am-btn-group am-btn-group-xs">
                            <a class="am-btn am-btn-default am-btn-xs am-text-secondary  edit-one edit-true">
                                <span class="am-icon-pencil-square-o"></span> 编辑
                            </a>
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


    <div class="am-modal am-modal-confirm" tabindex="-1" id="edit_form_modal">
        {!! Form::open(['url'=> url('admin',['roles','edit']), 'id' => 'edit_form', 'class'=> 'am-form am-modal-dialog am-form-horizontal']) !!}
        <fieldset>
            <h5>&nbsp;</h5>
            <div class="am-form-group">
                {!! Form::label('role', "角色名称", ['class' => 'am-u-sm-3']) !!}
                <div class="am-u-sm-9">
                    {!! Form::text('role', null, ['required' => 'required']) !!}
                </div>
            </div>

            <div class="am-form-group">
                {!! Form::label('role', "权限列表", ['class' => 'am-u-sm-3']) !!}
                <div class="am-u-sm-9 permission-lists">
                    @foreach($all_permissions as $one_pers)
                        @foreach($one_pers as $one_per)
                        <label class="am-checkbox-inline pull-left">
                            <input type="checkbox" value="{{ $one_per->id }}"  data-accept="@foreach($one_per->roles as $role)-{{ $role->id }}-@endforeach"
                                   data-am-ucheck >
                            {{ $one_per->permission_name }}
                        </label>
                        @endforeach
                        <div class="clearfix"></div>
                    @endforeach
                </div>
            </div>
            {!! Form::hidden('permissions') !!}
            {!! Form::hidden('id') !!}

            <div class="am-form-group am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="submit-btn am-btn">确定</span>
            </div>


        </fieldset>
        {!! Form::close() !!}
    </div>
    {{--</div>--}}
    <script>
        $(function() {

            $('.edit-one').click(function() {

                var $link = $(this);
                if($link.hasClass('edit-true')) { //编辑
                    $("#role").val($link.parents("tr").find("td").eq(1).find('a').html());
                    var $role_id = $link.siblings('.role-id').val();
                    $("input[name='id']").val($role_id);
                    //操作checkbox
                    $("#edit_form").find('input[type="checkbox"]').each(function () {

                        if($(this).data('accept').indexOf('-'+$role_id+'-') > -1) {
                            $(this).prop('checked', true);
                        }else{
                           $(this).prop('checked', false);
                        }
                    });


                } else if ($link.hasClass('add-true')) {
                    //$("#edit_form").find('input[name!="_token"||type!="checkbox"]').val('');
                    $('input[type="checkbox"]').prop('checked', false);
                    $('input[name="id"]').val('');
                    $('input[name="permissions"]').val('');
                    $("#role").val('');
                }

                $('#edit_form_modal').modal();
            });

            $(".submit-btn").on('click', function() {
                if(! $("input[name='role']").val()  ) {
                    alert('请填写字段内容');
                    return;
                }
                $('input[name="permissions"]').val('');//每次清空
                $("#edit_form").find('input[type="checkbox"]').each(function () {

                    if($(this).prop('checked')) {
                        $('input[name="permissions"]').val($('input[name="permissions"]').val()+','+$(this).val());
                    }
                });
                $("#edit_form").submit();
            })
        });
    </script>
</div>
<!-- content end -->
@endsection