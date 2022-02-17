@extends('frontend.main_master')
@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>Reset Password</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <!-- Sign-in -->            

<!-- Sign-in -->

<!-- create a new account -->
<div class="col-md-12 col-sm-12 create-new-account">
    <h4 class="checkout-subtitle">Password Reset</h4>
    <p class="text title-tag-line">Create new password in here</p>
    <form method="POST" action="{{ route('password.update') }}">
            @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div class="form-group">
            <label class="info-title" for="email">Email Address <span>*</span></label>
            <input type="email" class="form-control unicase-form-control text-input" id="email" name="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong> {{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="info-title" for="password">Password <span>*</span></label>
            <input type="password" class="form-control unicase-form-control text-input" id="password" name="password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong> {{ $message }}</strong>
            </span>
            @enderror
        </div>
         <div class="form-group">
            <label class="info-title" for="password_confirmation">Confirm Password <span>*</span></label>
            <input type="password" class="form-control unicase-form-control text-input" id="password_confirmation" name="password_confirmation">
            @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                <strong> {{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Reset Password</button>
    </form>
    
    
</div>  
<!-- create a new account -->           </div><!-- /.row -->
        </div><!-- /.sigin-in-->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
         @include('frontend.body.brand')
</.logo-slider-inner -->
    
</div><!-- /.logo-slider -->
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->    </div><!-- /.container -->
</div>
@endsection