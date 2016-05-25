@extends('layouts.master')
@include('layouts.menu')

@section('page')

<div class="col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">Fakers</div>

        <div class="panel-body">
            <p><b>{{ $faker->name }}</b></p>
            <p>{{ $faker->description }}</p>
            <p>{{ $faker->filename }}</p>
            <pre>{{ $faker->html }}</pre>

            <p><a class="btn btn-info" href="{{ URL::to('admin/fakers/' . $faker->id . '/edit') }}">Edit</a></p>
            <p>
                {{ Form::open(['url' => URL::to('admin/fakers/' . $faker->id), ]) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </p>
        </div>
    </div>

</div>

@stop
