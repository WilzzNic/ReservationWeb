@extends('adminlte::page')

@section('title', 'Reservation List')

@section('content_header')
<h1>
    Reservation List
</h1>


@stop

@section('content')
<table id="myTable" class="table" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th></th>
            <th>Customer</th>
            <th>Ordered Table</th>
            <th>Ordered Time</th>
            <th>Table Number</th>
            <th>Date Ordered</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
</table>
@stop

@section('js')
<script>
$(document).ready(function() {
    function format (d) {
        var a = '<table>'
                +'<tr>'
                    +'<th>Food Name</th>'
                    +'<th>Amount</th>'
                +'</tr>'
        
        if(d.foods === undefined || d.foods.length == 0) {
            return '<p>No foods ordered.</p>'
        }
        else {
            d.foods.forEach(function(food){
            a = a.concat('<tr>'
                        + '<td>' + food.food_name + '</td>'
                        + '<td>' + food.pivot.amount + '</td>'
                    + '</tr>');
            });
            return a + '</table>';
        }
    };

    var dt = $('#myTable').DataTable({
		processing: true,
		serverSide: true,
		pageLength: 10,
		scrollX: true,
		ajax: '{!! route('ordersdata') !!}',
		columns: [
            {
                orderable: false, searchable: false,width: '0.5%',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            {
                "className":      'details-control',
                "orderable":      false,
                "searchable":     false,
                "data":           null,
                width: "1%",
                "defaultContent": '<a class="fa fa-plus"></a>',
            },
            { data: 'customer.cust_name' },
		    { data: 'table_demand', width: '10%',
              render: function(data, type, row, meta) {
                    if(data <= 1) {
                        return data + ' person';
                    }
                    else {
                        return data + ' persons';
                    }
              } 
            },
		    { data: 'schedule.time_provided', width: "10%" },
            { data: 'table.table_no', width: "8%",
              render: function(data, type, row, meta) {
                        if(data == null) {
                            return '-';
                        }
                        else {
                            return data;
                        }
              }
            },
            { data: 'reservation_date', width: '10%' },
            { data: 'status', width: "8%" },
            { data: 'action', name: 'action', orderable: false, searchable: false }
		]
	});

    var detailRows = [];

    $('#myTable tbody').on( 'click', 'tr td.details-control', function () {
        var tr = $(this).closest('tr');
        var a = $(this).children();
        var row = dt.row( tr );
        var idx = $.inArray( tr.attr('id'), detailRows );
 
        if ( row.child.isShown() ) {
            tr.removeClass( 'details' );
            a.toggleClass("fa fa-minus");
            a.toggleClass("fa fa-plus");
            row.child.hide();
 
            // Remove from the 'open' array
            detailRows.splice( idx, 1 );
        }
        else {
            a.toggleClass("fa fa-minus");
            a.toggleClass("fa fa-plus");
            tr.addClass( 'details' );
            row.child( format( row.data() ) ).show();
 
            // Add to the 'open' array
            if ( idx === -1 ) {
                detailRows.push( tr.attr('id') );
            }
        }
    } );
        // On each draw, loop over the `detailRows` array and show any child rows
    dt.on( 'draw', function () {
        $.each( detailRows, function ( i, id ) {
            $('#'+id+' td.details-control').trigger( 'click' );
        } );
    } );
});
</script>
@stop


