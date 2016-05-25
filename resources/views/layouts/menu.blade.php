@section('menu')
<div class="col-md-3">
    <div class="panel panel-default">
        <div class="panel-heading">Menu</div>
        <ul class="list-group">
            <li class="list-group-item"><a href="{{ URL::to('admin/images') }}">Images</a></li>
            <li class="list-group-item"><a href="{{ URL::to('admin/exploits') }}">Exploits</a></li>
            <li class="list-group-item"><a href="{{ URL::to('admin/fakers') }}">Fakers</a></li>
        </ul>
    </div>
</div>
@stop
