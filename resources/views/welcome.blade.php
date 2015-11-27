<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        {{--<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
--}}
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Welcome
                    @if(! is_null( Illuminate\Support\Facades\Auth::user() ))
                        {{  Illuminate\Support\Facades\Auth::user()->username }}
                    @else
                        <a href="/auth/login">Login</a>
                    @endif
                </div>
                @if(!is_null( Illuminate\Support\Facades\Auth::user()))
                    <a href="/auth/logout">Logout</a>
                @endif
            </div>
        </div>
    </body>
</html>
