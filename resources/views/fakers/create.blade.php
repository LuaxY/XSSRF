@extends('layouts.master')
@include('layouts.menu')

@section('page')

<div class="col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">Fakers</div>

        <div class="panel-body">

            {{ Html::ul($errors->all()) }}

            {{ Form::open(['url' => URL::to('admin/fakers')]) }}

                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', old('name'), array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('description', 'Description') }}
                    {{ Form::text('description', old('description'), array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('filename', 'Filename') }}
                    {{ Form::text('filename', old('filename'), array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('html', 'HTML') }}
                    <p>MUST contain <code>%EXPLOIT%</code></p>
                    {{ Form::textarea('html', old('html'), array('class' => 'form-control')) }}
                </div>

                {{ Form::submit('Create faker', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}

        </div>

</div>

@stop
