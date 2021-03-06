<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <meta name="robots" content="noindex, nofollow" />

    <title>404 Not Found</title>

    <link rel="icon" type="image/png" href="favicon.png" />

    <style type="text/css" media="screen">
        html, body{
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            vertical-align: baseline;
        }
        body{
            font: 100%/160% Georgia, Constantia,
            "Lucida Bright", LucidaBright,
            "DejaVu Serif", "Bitstream Vera Serif",
            "Liberation Serif", Times, Serif;
            text-align: center;
            color: #2A2925;
            background: #E1E0DC;
            padding-top: 10%;
        }
        img{
            float: right;
            width: 25%;
            min-width: 150px;
            max-width: 300px;
            height: auto;
            margin-top: -5%;
        }
        p{
            margin: 0;
            padding: 0 2% 2% 2%;
            line-height: 1em;
            font-size: 1.8em;
        }
        .error{ font-size: 4em; }
        .funny{ font-style: italic; }
        a, a:link, a:visited{
            color: #fff;
            background: #2A2925;
            text-decoration: none;
            padding: .2em .4em;
            line-height: 2em;
            -webkit-border-radius: .5em;
            -moz-border-radius: .5em;
            border-radius: .5em;
        }
        a:hover{ background: #281d30; }
    </style>
</head>
<body>
    <img src="/images/3.png" alt="troopers needs cofee too!" />

    <p class="error">404 Not Found</p><p class="funny">No Coffee, No Workee!</p>

    <p><a href="{{ URL::previous() }}" title="Back to the previous page">Go Back</a></p>
</body>
</html>