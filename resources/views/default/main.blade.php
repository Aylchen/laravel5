<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Laravel</title>
    {!! Html::style('/css/bootstrap.min.css') !!}
    {!! Html::theme_style('/css/style.css') !!}
    {!! Html::script('/js/jquery.min.js') !!}
    {!! Html::script('/js/bootstrap.min.js') !!}
    {!! Html::style('/assets/css/amazeui.min.css') !!}

</head>
<body>
<div class="container">
    @include('nav')
    <div class="content" style="position:relative">
        @yield('content')
    </div>
    <footer>
        <p class="text-center">&copy;<em>Aylchen</em></p>
    </footer>
</div>
</body>
</html>
