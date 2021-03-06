<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>laravel blog后台管理系统</title>
    <meta name="_token" content="{{ csrf_token() }}"/>
    <meta name="description" content="laravel blog Description">
    <meta name="keywords" content="table">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">{{--
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">--}}
    <link rel="icon" type="image/png" href="/images/favicon.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    {!! Html::style('/assets/css/amazeui.min.css') !!}
    {!! Html::style('/assets/css/admin.css') !!}
    {!! Html::style('/css/bootstrap.min.css') !!}
    {!! Html::script("/js/jquery.min.js") !!}
    {!! Html::script("/assets/js/amazeui.min.js") !!}
    {!! Html::script("/assets/js/app.js") !!}

</head>
<body>

<header class="am-topbar admin-header">
    <div class="am-topbar-brand">
        <strong>Laravel Blog</strong> <small>后台管理系统</small>
    </div>

    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

    <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
            <li class="am-dropdown" data-am-dropdown>
                <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                    <span class="am-icon-users"></span> {{  \App\Admin::user()->username }} <span class="am-icon-caret-down"></span>
                </a>
                <ul class="am-dropdown-content">
                     <li><a href="{{ url('/') }}"><span class="am-icon-home"></span> 前台</a></li>
                     {{--<li><a href="#"><span class="am-icon-cog"></span> 设置</a></li>--}}
                    <li><a href="{{ url('admin','logout') }}"><span class="am-icon-power-off"></span> 退出</a></li>
                </ul>
            </li>
            <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
        </ul>
    </div>
</header>

<div class="am-cf admin-main">
    @include('amazeui.sidebar')
    <div class="admin-content" style="min-height:800px;">
        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">{{ $nav }}</strong> {{--/ <small>Table</small>--}}</div>
            @if(!empty($with_add) && $with_add = true)
                <button type="button" class="am-btn am-btn-primary am-align-right edit-one add-true" >添加</button>
            @endif
        </div>


        <div class="am-g">
            <div class="am-u-sm-12">
                @yield('content_table')
            </div>
            @if(! empty($current_form))
            {!! Form::open(['url'=> url('admin',[$current_form,'delete']), 'id' => $current_form.'_form']) !!}
            {!! Form::hidden('delete_id', null, ['id' => 'opera_id']) !!}
            {!! Form::close() !!}

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
                                $("#{{$current_form }}_form").submit();
                            }
                        });
                    });
                });
            </script>
            @endif
        </div>

    </div>
</div>

<footer data-am-widget="footer" class="am-footer am-footer-default" data-am-footer="{  }">
    <div class="am-footer-miscs ">
        <p>模板来自<a href="javascript:void(0)" title="amazeui" target="_blank" class="">amazeui</a></p>
        <p>CopyRight©Aylchen.</p>
    </div>
</footer>
</body>
</html>