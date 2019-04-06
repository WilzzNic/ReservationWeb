@extends('adminlte::page')

@section('title', 'Schedules List')

@section('content_header')
<h1>
    Tables List
    <a type="button" class='btn btn-success pull-right' href="{{ route('tables.create') }}">
        <i class='fa fa-plus'></i> &nbsp; Add Table
    </a>
</h1>


@stop

@section('content')
<table id="myTable" class="display" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Restaurant Name</th>
            <th>Table Type</th>
            <th>Table Number</th>
            <th>Actions</th>
        </tr>
    </thead>
</table>
@stop

@section('js')
<script>
$(document).ready(function() {
    var groupColumn = 1;
    $('#myTable').DataTable({
        processing: true,
		serverSide: true,
		pageLength: 10,
		scrollX: true,
		ajax: '{!! route('tabledata') !!}',
		columns: [
            {
                orderable: false, searchable: false,width: '0.5%',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            { data: 'restaurant.rest_name' },
            { data: 'table_type',
                render: function(data, type, row, meta) {
                    if(data <= 1) {
                        return data + ' person';
                    }
                    else {
                        return data + ' persons';
                    }
                }
            },
            { data: 'table_no' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
		],
        "columnDefs": [
            { "visible": false, "targets": groupColumn }
        ],
        "order": [[ groupColumn, 'asc' ]],
        "displayLength": 25,
        "drawCallback": function (settings) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last = null;
 
            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            });
        }
    });
});
</script>
@stop

@section('css')
    <style>
        tr.group, tr.group:hover {
            background-color: #ddd !important;
            font-weight: bold;
            font-style: italic;
        }
    </style>
@stop
