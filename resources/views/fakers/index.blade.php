@extends('layouts.master')
@include('layouts.menu')

@section('page')

<div class="col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">Fakers</div>

        <div class="panel-body">
            <p><a class="btn btn-info" href="{{ URL::to('admin/fakers/create') }}">New</a></p>
        </div>

        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Filename</th>
                <th class="text-right">Actions</th>
            </tr>

            @foreach($fakers as $faker)
                <tr>
                    <td>{{ $faker->id }}</td>
                    <td>{{ $faker->name }}</td>
                    <td>{{ $faker->description }}</td>
                    <td>{{ $faker->filename }}</td>
                    <td class="text-right">
                        <a class="btn btn-xs btn-success" href="{{ URL::to('admin/fakers/' . $faker->id) }}">Show</a>
                        <a class="btn btn-xs btn-info" href="{{ URL::to('admin/fakers/' . $faker->id . '/edit') }}">Edit</a>
                        &nbsp;
                        {{ Form::open(['url' => URL::to('admin/fakers/' . $faker->id), 'class' => 'pull-right']) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach

        </table>
    </div>

</div>

@stop
