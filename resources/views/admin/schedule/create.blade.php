@extends('adminlte::page')

@section('title', 'Add Schedule')

@section('content_header')
<h1>Add Schedule</h1>
@stop

@section('content')
<div class="container-fluid spark-creen">
    <div class="row">
        <div class="col-md-9">
            <div class="container-fluid">
                <form class="form-horizontal" action="{{route('schedules.store')}}" autocomplete="off" method="POST">
                    @csrf

                    <div class="form-group {{ $errors->has('restaurant') ? 'has-error' : '' }}">
                        <label for="restaurant_name" class="col-md-2 control-label">Restaurant Name</label>
                        <div class="col-md-10">
                            <select id="restaurant_name" name="restaurant" class="form-control select2" aria-describedby="error_restaurant_name">
                                <option disabled selected>-- Choose Restaurant --</option>
                                @foreach ($restaurants as $a)
                                    <option value="{{ $a->id }}" style="text-transform: capitalize" {{ old('restaurant') == $a->rest_name ? 'selected' : '' }}>{{$a->rest_name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('restaurant'))
                                <span id="error_restaurant_name" class="help-block">{{ $errors->first('restaurant') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('time_provided') ? 'has-error' : '' }}">
                        <label for="schedule" class="col-md-2 control-label">Schedule</label>
                        <div class="col-md-10">
                            <input type="time" id="schedule" name="time_provided" aria-describedby="error_schedule" value="{{ old('time_provided') }}">
                            @if($errors->has('time_provided'))
                                <span id="error_schedule" class="help-block">{{ $errors->first('time_provided') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<style>
    .select2 {
        width:100%!important;
    }
    input[type=time] {
        margin: 1px;
        min-width: 50px;
    }
</style>
@stop

@section('js')
<script type="text/javascript ">
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>
@stop