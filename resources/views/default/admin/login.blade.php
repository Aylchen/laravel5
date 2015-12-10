@extends('admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">后台登录</div>
                    <div class="panel-body">
                  {{--      @if (Session::has('msg'))
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>

                                    <li>{{ Session::get('msg') }}</li>

                                </ul>
                            </div>
                        @endif--}}

                        {!! Form::open(['class' => 'form-horizontal']) !!}

                            <div class="form-group">
                                {!! Form::label('username', 'Username: ', ['class' => "col-md-4 control-label" ]) !!}
                                <div class="col-md-6">
                                    {!! Form::text('username',  null, ['class' => "form-control" ]) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('password', 'Password: ', ['class' => "col-md-4 control-label" ]) !!}
                                <div class="col-md-6">
                                    {!! Form::password('password',  ['class' => "form-control" ]) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    {!! Form::submit("Submit", ['class' => "btn btn-primary"]) !!}

                                    <span class="am-text-danger ">{{ empty($error_msg) ?  "" : $error_msg }}</span>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
