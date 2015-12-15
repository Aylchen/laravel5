<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Laravel Blog</title>
    @include('source')
</head>
<body>
<div class="container">
    @include('nav')
    <div class="content" style="position:relative; min-height:840px;">
        @yield('content')
    </div>
    <footer>
        <p class="text-center">&copy;<em>Aylchen</em></p>
    </footer>
</div>
</body>
</html>
