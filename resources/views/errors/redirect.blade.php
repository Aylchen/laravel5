@extends('main')

@section('content')
    <h1> {{ $msg }} </h1>
    <h3><small>3</small>&nbsp;秒后跳转至前页</h3>
    <script>
        var timer = $('h3 > small').html()*1;
        setInterval(function() {
            timer-=1;
            if(timer<1){
                history.back(-1);
                return;
            }
            $('h3 > small').html(timer);
        },1000);
    </script>

@endsection


