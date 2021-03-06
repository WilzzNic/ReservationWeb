@extends('adminlte::page')

@section('title', 'Edit Schedule')

@section('content_header')
<h1>Edit Schedule</h1>
@stop

@section('content')
<div class="container-fluid spark-creen">
    <div class="row">
        <div class="col-md-9">
            <div class="container-fluid">
                <form class="form-horizontal" action="{{ route('schedules.update', ['id' => $schedule->id]) }}" autocomplete="off" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group {{ $errors->has('restaurant') ? 'has-error' : '' }}">
                        <label for="restaurant_name" class="col-md-2 control-label">Restaurant Name</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $schedule->restaurant->rest_name }}</p>
                            @if($errors->has('restaurant'))
                                <span id="error_restaurant_name" class="help-block">{{ $errors->first('restaurant') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('time_provided') ? 'has-error' : '' }}">
                        <label for="schedule" class="col-md-2 control-label">Schedule</label>
                        <div class="col-md-10">
                            <input type="time" id="schedule" name="time_provided" aria-describedby="error_schedule" value="{{ old('time_provided') == null ? $schedule->time_provided : old('time_provided')}}">
                            @if($errors->has('time_provided'))
                                <span id="error_schedule" class="help-block">{{ $errors->first('time_provided') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <input type="hidden" name="restaurant" value="{{$schedule->restaurant->id}}">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop