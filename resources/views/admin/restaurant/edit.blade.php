@extends('adminlte::page')

@section('title', 'Edit Restaurant')

@section('content_header')
<h1>Edit Restaurant</h1>
@stop

@section('content')
<div class="container-fluid spark-creen">
    <div class="row">
        <div class="col-md-9">
            <div class="container-fluid">
                <form class="form-horizontal" action="{{ route('restaurants.update', ['id' => $restaurant->id]) }}" enctype='multipart/form-data' autocomplete="off" method="POST">
                    @csrf
                    @method('PUT')
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
                            <input type="text" class="form-control" id="username" name="username" value="{{ $restaurant->user->username }}" aria-describedby="error_username">
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
                            @if($errors->has('password') && $errors->first('password') != "Konfirmasi Password salah.")
                                <span id="error_password" class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>

                    {{--Confirmation Password --}}
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password_confirmation" class="col-md-2 control-label">Confirm Password</label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" aria-describedby="error_conf_password">
                            @if($errors->has('password') && $errors->first('password') == 'Konfirmasi Password salah.')
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
                            <input type="text" class="form-control" id="rest_name" name="rest_name" aria-describedby="error_rest_name" value="{{ $restaurant->rest_name }}">
                            @if($errors->has('rest_name'))
                                <span id="error_rest_name" class="help-block">{{ $errors->first('rest_name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                        <label for="address" class="col-md-2 control-label">Address</label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="address" name="address" aria-describedby="error_address">{{ $restaurant->address }}</textarea>
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
                                <input type="text" class="form-control" id="telp_no" name="telp_no" aria-describedby="telp_no" value="{{ ltrim($restaurant->telp_no, '+62') }}">
                            </div>
                            @if($errors->has('telp_no'))
                                <span id="error_telp_no" class="help-block">{{ $errors->first('telp_no') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                        <label for="description" class="col-md-2 control-label">Description</label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="description" name="description" aria-describedby="error_description">{{ $restaurant->description }}</textarea>
                            @if($errors->has('description'))
                                <span id="error_description" class="help-block">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                        <label for="start_time" class="col-md-2 control-label">Start of Operational Time</label>
                        <div class="col-md-10">
                            <input type="time" class="form-control" id="start_time" name="start_time" aria-describedby="error_start_time" value="{{ trim(explode('-', $restaurant->open_time)[0]) }}">
                            @if($errors->has('start_time'))
                                <span id="error_start_time" class="help-block">{{ $errors->first('start_time') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('end_time') ? 'has-error' : '' }}">
                        <label for="end_time" class="col-md-2 control-label">End of Operational Time</label>
                        <div class="col-md-10">
                            <input type="time" class="form-control" id="end_time" name="end_time" aria-describedby="error_end_time" value="{{ trim(explode('-', $restaurant->open_time)[1]) }}">
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
                                        <img src="{{ asset('storage/' . $restaurant->profile_pic) }}" alt="Profile Picture" id="img_profile_pic">
                                    </a>
                                </div>
                            </div>
                            <div class="inline-content">
                                <input type="file" class="btn btn-default" name="profile_pic" id="profile_pic" onchange="readURL(this, 0);">
                            </div>
                            <div class="inline-content">
                                <a onclick="removeFile(0)" class="btn btn-danger"><i class="fa fa-close"></i></a>
                            </div>
                            <p class="help-block">Choose file for new profile picture.</p>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="cover_pic" class="col-md-2 control-label">Cover Picture</label>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-xs-6 col-md-3">
                                    <a class="thumbnail">
                                        <img src="{{ asset('storage/' . $restaurant->cover_pic) }}" alt="Cover Picture" id="img_cover_pic" width="200" height="200">
                                    </a>
                                </div>
                            </div>
                            <div class="inline-content">
                                <input type="file" name="cover_pic" id="cover_pic" class="btn btn-default" onchange="readURL(this, 1);">
                            </div>
                            <div class="inline-content">
                                <a onclick="removeFile(1)" class="btn btn-danger"><i class="fa fa-close"></i></a>
                            </div>
                            <p class="help-block">Choose file for new cover picture.</p>
                        </div>
                    </div>
                    
                    <input type="hidden" name="id" value="{{ $restaurant->user->id }}">
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

    $(document).ready(function() {
        var val1 = "<?php echo $restaurant->profile_pic ?>";
        var val2 = "<?php echo $restaurant->cover_pic ?>";
        if(val1 == "") {
            removeFile(0);
        }
        if(val2 == "") {
            removeFile(1);
        } 
    });

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
