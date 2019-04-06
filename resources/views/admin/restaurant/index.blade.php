@extends('adminlte::page')

@section('title', 'Restaurant List')

@section('content_header')
<h1>
    Restaurant List
    <a type="button" class='btn btn-success pull-right' href="{{ route('restaurants.create') }}">
        <i class='fa fa-plus'></i> &nbsp; Add Restaurant
    </a>
</h1>


@stop

@section('content')
<table id="myTable" class="display" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>Restaurant Name</th>
            <th>Address</th>
            <th>Telp. No</th>
            <th>Open Time</th>
            <th>Actions</th>
        </tr>
    </thead>
</table>
@stop

@section('js')
<script>
$(document).ready(function() {
    $('#myTable').DataTable({
		processing: true,
		serverSide: true,
		pageLength: 10,
		scrollX: true,
		ajax: '{!! route('restaurantdata') !!}',
		columns: [
            {
                orderable: false, searchable: false,width: '0.5%',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            { data: 'user.username' },
		    { data: 'rest_name' },
		    { data: 'address' },
            { data: 'telp_no' },
            { data: 'open_time' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
		]
	});
});
</script>
@stop

