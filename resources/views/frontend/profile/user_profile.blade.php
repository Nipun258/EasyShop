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
              <h3 class="text-center"><span class="text-danger">Hi....</span><strong>{{ Auth::user()->name}}</strong> Update Your Profile</h3>

              <div class="card-body">
              	<form method="POST" action="{{ route('user.profile.update')}}" enctype="multipart/form-data">
            @csrf
        <div class="form-group">
            <label class="info-title" for="email">Email Address </label>
            <input type="email" class="form-control text-input" id="email" name="email" value="{{ $user->email}}">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong> {{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="info-title" for="name">Name</label>
            <input type="text" class="form-control text-input" id="name" name="name" value="{{ $user->name}}">
             @error('name')
            <span class="invalid-feedback" role="alert">
                <strong> {{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="info-title" for="phone">Phone</label>
            <input type="text" class="form-control text-input" id="phone" name="phone" value="{{ $user->phone}}" >
             @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong> {{ $message }}</strong>
            </span>
            @enderror
        </div>

	<div class="form-group">
		    <label class="info-title" for="phone">User Image</label>
			<input type="file" class="form-control" name="profile_photo_path" id="profile_photo_path">
			<img id="showImage" src="{{ (!empty($user->profile_photo_path))? url('upload/user_images/'.$user->profile_photo_path):url('upload/images.png')}}" style="width: 100px; width: 100px; border: 1px solid #000000;">
	</div>

        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Update</button>
    </form>       
              </div>
            </div>
        </div>
    </div>
    <br>
</div>
				<script type="text/javascript">
	              $(document).ready(function(){
		           $('#profile_photo_path').change(function(e){
			        var reader = new FileReader();
			            reader.onload = function(e){
				       $('#showImage').attr('src',e.target.result);
			          }
		      	reader.readAsDataURL(e.target.files['0']);
		        });
	           });
				</script>
@endsection
