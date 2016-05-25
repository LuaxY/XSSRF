@extends('layouts.master')
@include('layouts.menu')

@section('page')

<div class="col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">Fakers</div>

        <div class="panel-body">

            {{ Html::ul($errors->all()) }}

            {{ Form::model($faker, array('url' => URL::to('admin/fakers/' . $faker->id), 'method' => 'PUT')) }}

                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', null, array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('description', 'Description') }}
                    {{ Form::text('description', null, array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('filename', 'Filename') }}
                    {{ Form::text('filename', null, array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('html', 'HTML') }}
                    <p>MUST contain <code>%EXPLOIT%</code></p>
                    {{ Form::textarea('html', null, array('class' => 'form-control')) }}
                </div>

                {{ Form::submit('Update faker', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}

        </div>

</div>

@stop
