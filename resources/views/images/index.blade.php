@extends('layouts.master')
@include('layouts.menu')

@section('page')

<div class="col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">Images</div>

        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>File</th>
                <th>Date</th>
                <th class="text-right">Actions</th>
            </tr>

            @foreach($images as $image)
                <tr>
                    <td>{{ $image->id }}</td>
                    <td>{{ $image->realname }}</td>
                    <td>{{ $image->created_at }}</td>
                    <td class="text-right">
                        <a class="btn btn-xs btn-success" href="{{ URL::to('i/' . $image->filename) }}">Show</a>
                        <a class="btn btn-xs btn-info" href="{{ URL::to('admin/images/' . $image->id . '/edit') }}">Edit</a>
                        &nbsp;
                        {{ Form::open(['url' => URL::to('admin/images/' . $image->id), 'class' => 'pull-right']) }}
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
