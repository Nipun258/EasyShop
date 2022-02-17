@extends('frontend.main_master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <br>
                <img class="card-img-top" style="border-radius: 50%;" src="{{ (!empty($user->profile_photo_path))? url('upload/user_images/'.$user->profile_photo_path):url('upload/images.png')}}" height="100%" width="100%"><br><br>
                <ul class="list-group list-group-flush">
                    <a href="{{ route('dashboard')}}" class="btn btn-primary btn-sm btn-block">Home</a>
                    <a href="{{ route('user.profile')}}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                    <a href="{{ route('change.password')}}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                    <a href="{{ route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a>
                </ul>

            </div>
            <div class="col-md-2">
                

            </div>
            <div class="col-md-6">
              <h3 class="text-center"><span class="text-danger">Hi....</span><strong>{{ Auth::user()->name}}</strong> Change Your Password</h3><br>

              <div class="card-body">
              	<form method="POST" action="{{ route('user.password.change')}}" >
            @csrf
        <div class="form-group">
            <label class="info-title" for="email">Current Password </label>
            <input type="password" class="form-control text-input" id="current_password" name="oldpassword" value="">
            @error('oldpassword')
            <span class="text-danger" role="alert">
                <strong> {{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="info-title" for="name">New Password</label>
            <input type="password" class="form-control text-input" id="password" name="password" value="">
             @error('password')
            <span class="text-danger" role="alert">
                <strong> {{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="info-title" for="phone">Confirm Password</label>
            <input type="password" class="form-control text-input" id="password_confirmation" name="password_confirmation" value="" >
             @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                <strong> {{ $message }}</strong>
            </span>
            @enderror
        </div>

        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Change</button>
    </form>       
              </div>
            </div>
        </div>
    </div>
    <br>
</div>
@endsection
