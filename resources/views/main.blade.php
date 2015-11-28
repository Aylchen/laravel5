<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Laravel</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/css/style.css" rel="stylesheet" type="text/css">
    <script src="/js/jquery.min.js"></script>
</head>
<body>
<div class="container">
    @include('nav')
    @yield('content')
</div>
</body>
</html>
