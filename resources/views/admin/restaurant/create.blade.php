@extends('adminlte::page')

@section('title', 'Add Restaurant')

@section('content_header')
<h1>Add Restaurant</h1>
@stop
{{-- {{dd(old('saudara'))}} --}}
@section('content')
<div class="container-fluid spark-creen">
    <div class="row">
        <div class="col-md-9">
            <div class="container-fluid">
                <form class="form-horizontal" action="{{route('restaurants.store')}}" enctype='multipart/form-data' autocomplete="off" method="POST">
                    @csrf
                    {{-- Title: Login Credentials --}}
                    <div class="row">
                        <div class="col">
                            <h4 class="form-control-static" style="color:grey;"><strong>Login Credentials</strong></h4>
                            <hr style="margin-top:0; border:1px solid lightgrey">
                        </div>
                    </div>

                    {{-- Username --}}
                    <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                        <label for="username" class="col-md-2 control-label">Username</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" aria-describedby="error_username">
                            @if($errors->has('username'))
                                <span id="error_username" class="help-block">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                    </div>

                    {{--Password --}}
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password" class="col-md-2 control-label">Password</label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" id="password" name="password" aria-describedby="error_password">
                            @if($errors->has('password') && $errors->first('password') != "The password confirmation does not match.")
                                <span id="error_password" class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>

                    {{--Confirmation Password --}}
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password_confirmation" class="col-md-2 control-label">Confirm Password</label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" aria-describedby="error_conf_password">
                            @if($errors->has('password') && $errors->first('password') == 'The password confirmation does not match.')
                                <span id="error_conf_password" class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- Title: Restaurant Info --}}
                    <div class="row">
                        <div class="col">
                            <h4 class="form-control-static" style="color:grey;"><strong>Restaurant Info</strong></h4>
                            <hr style="margin-top:0; border:1px solid lightgrey">
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('rest_name') ? 'has-error' : '' }}">
                        <label for="rest_name" class="col-md-2 control-label">Restaurant Name</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="rest_name" name="rest_name" aria-describedby="error_rest_name" value="{{ old('rest_name') }}">
                            @if($errors->has('rest_name'))
                                <span id="error_rest_name" class="help-block">{{ $errors->first('rest_name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                        <label for="address" class="col-md-2 control-label">Address</label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="address" name="address" aria-describedby="error_address">{{ old('address') }}</textarea>
                            @if($errors->has('address'))
                                <span id="error_address" class="help-block">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('telp_no') ? 'has-error' : '' }}">
                        <label for="telp_no" class="col-md-2 control-label">Phone Number</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <span class="input-group-addon" id="telp_no">+62</span>
                                <input type="text" class="form-control" id="telp_no" name="telp_no" aria-describedby="telp_no" value="{{ old('telp_no') }}">
                            </div>
                            @if($errors->has('telp_no'))
                                <span id="error_telp_no" class="help-block">{{ $errors->first('telp_no') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                        <label for="description" class="col-md-2 control-label">Description</label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="description" name="description" aria-describedby="error_description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                                <span id="error_description" class="help-block">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                        <label for="start_time" class="col-md-2 control-label">Start of Operational Time</label>
                        <div class="col-md-10">
                            <input type="time" class="form-control" id="start_time" name="start_time" aria-describedby="error_start_time" value="{{ old('start_time') }}">
                            @if($errors->has('start_time'))
                                <span id="error_start_time" class="help-block">{{ $errors->first('start_time') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('end_time') ? 'has-error' : '' }}">
                        <label for="end_time" class="col-md-2 control-label">End of Operational Time</label>
                        <div class="col-md-10">
                            <input type="time" class="form-control" id="end_time" name="end_time" aria-describedby="error_end_time" value="{{ old('end_time') }}">
                            @if($errors->has('end_time'))
                                <span id="error_end_time" class="help-block">{{ $errors->first('end_time') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="profile_pic" class="col-md-2 control-label">Profile Picture</label>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-xs-6 col-md-3">
                                    <a class="thumbnail">
                                        <img alt="Profile Picture" id="img_profile_pic">
                                    </a>
                                </div>
                            </div>
                            <div class="inline-content">
                                <input type="file" class="btn btn-default" name="profile_pic" id="profile_pic" onchange="readURL(this, 0);">
                            </div>
                            <div class="inline-content">
                                <a onclick="removeFile(0)" class="btn btn-danger"><i class="fa fa-close"></i></a>
                            </div>
                            <p class="help-block">Choose file for initial profile picture.</p>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="cover_pic" class="col-md-2 control-label">Profile Picture</label>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-xs-6 col-md-3">
                                    <a class="thumbnail">
                                        <img alt="Cover Picture" id="img_cover_pic" width="200" height="200">
                                    </a>
                                </div>
                            </div>
                            <div class="inline-content">
                                <input type="file" name="cover_pic" id="cover_pic" class="btn btn-default" onchange="readURL(this, 1);">
                            </div>
                            <div class="inline-content">
                                <a onclick="removeFile(1)" class="btn btn-danger"><i class="fa fa-close"></i></a>
                            </div>
                            <p class="help-block">Choose file for initial cover picture.</p>
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
    <style>
        img {
            max-width: 150px;
            max-height: 150px;
        }

        .inline-content {
            display: inline-block;
        }
    </style>
@stop

@section('js')
<script>
    function removeFile($i) {
        if($i == 0) {
            document.getElementById("profile_pic").value = "";
            $('#img_profile_pic').attr('src', 'https://via.placeholder.com/150');
        }
        else {
            document.getElementById("cover_pic").value = "";
            $('#img_cover_pic').attr('src', 'https://via.placeholder.com/150');
        }
    }

    function readURL(input, $i) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            if($i == 0) {
                reader.onload = function (e) {
                    $('#img_profile_pic').attr('src', e.target.result);
                };
            }
            else {
                reader.onload = function (e) {
                    $('#img_cover_pic').attr('src', e.target.result);
                };
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@stop