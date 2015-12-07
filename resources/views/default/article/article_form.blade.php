<div class="form-group">
    {!! Form::label('title','Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Input The Title']) !!}
</div>

<div class="form-group">
    {!! Form::label('content','Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Input The Content']) !!}
</div>

{!! Form::submit('Submit', ['class'=>'btn btn-primary form-control']) !!}