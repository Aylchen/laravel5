<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <style>
            .container {
                text-align: center;
            }
            .title {
                font-size: 96px;
                padding-top: 10%;
            }
            .navbar {
                width: 70%;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <div class="container">
            @include('nav')
            <div class="content">
                <div class="title">Welcome</div>
            </div>
        </div>
    </body>
</html>
