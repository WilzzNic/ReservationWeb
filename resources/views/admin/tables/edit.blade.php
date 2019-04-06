@extends('adminlte::page')

@section('title', 'Edit Table')

@section('content_header')
<h1>Edit Table</h1>
@stop

@section('content')
<div class="container-fluid spark-creen">
    <div class="row">
        <div class="col-md-9">
            <div class="container-fluid">
                <form class="form-horizontal" action="{{route('tables.update', ['id' => $table->id]) }}" autocomplete="off" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="restaurant_name" class="col-md-2 control-label">Restaurant Name</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $table->restaurant->rest_name }}</p>
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('table_type') ? 'has-error' : '' }}">
                        <label for="table_type" class="col-md-2 control-label">Table Type</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <input type="number" id="table_type" class="form-control" min="1" name="table_type" aria-describedby="table_type" value="{{ old('table_type') == null ? $table->table_type : old('table_type') }}">
                                <span class="input-group-addon" id="table_type">person</span>
                            </div>
                            
                            @if($errors->has('table_type'))
                                <span id="table_type" class="help-block">{{ $errors->first('table_type') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('table_no') ? 'has-error' : '' }}">
                        <label for="table_no" class="col-md-2 control-label">Table Number</label>
                        <div class="col-md-10">
                            <input type="text" id="table_no" class="form-control" min="1" name="table_no" aria-describedby="table_no" value="{{ old('table_no') == null ? $table->table_no : old('table_no') }}">    
                            @if($errors->has('table_no'))
                                <span id="table_no" class="help-block">{{ $errors->first('table_no') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <input type="hidden" name="restaurant" value="{{$table->restaurant->id}}">

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop