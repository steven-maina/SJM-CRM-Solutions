@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Login')

@section('vendor-style')
<!-- Vendor -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
@endsection

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/pages-auth.js')}}"></script>
@endsection

@section('content')
<div class="authentication-wrapper authentication-cover authentication-bg">

  <div class="authentication-inner row">
    <div class="left-side">
      <nav>
        <img src={{ asset('app-assets/images/bglogo.png') }} class="logo" alt="SJM CRM" />
      </nav>
    </div>
    <!-- /Left Text -->
    <div class="d-none d-lg-flex col-lg-7 p-0">
      <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
{{--        <img src="{{ asset('assets/img/illustrations/auth-login-illustration-'.$configData['style'].'.png') }}" alt="auth-login-cover" class="img-fluid my-5 auth-illustration" data-app-light-img="illustrations/auth-login-illustration-light.png" data-app-dark-img="illustrations/auth-login-illustration-dark.png">--}}
{{--        <img src="{{ asset('assets/img/illustrations/bg-shape-image-'.$configData['style'].'.png') }}" alt="auth-login-cover" class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.png">--}}


        <img src="{{ asset('assets/img/pages/login-v2-'.$configData['style'].'.svg') }}" alt="auth-login-cover" class="img-fluid my-5 auth-illustration" data-app-light-img="pages/login-v2-light.svg" data-app-dark-img="pages/login-v2-dark.svg">
        <img src="{{ asset('assets/img/illustrations/bg-shape-image-'.$configData['style'].'.png') }}" alt="auth-login-cover" class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.png">

      </div>
    </div>
    <!-- /Left Text -->

    <!-- Login -->
    <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
      <div class="w-px-400 mx-auto">
        <!-- Logo -->
        <div class="app-brand mb-4">
          <a href="{{url('/')}}" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">@include('_partials.macros',["height"=>20,"withbg"=>'fill: #fff;'])</span>
{{--            <span class="app-brand-logo demo"><img src="" "height"/></span>--}}
          </a>
        </div>
        <!-- /Logo -->
        <h3 class=" mb-1 fw-bold">Jambo, Welcome to SJM CRM Solution! 👋</h3>
        <p class="mb-4">Please sign-in to your account and start the adventure</p>

        <form id="formAuthentication" class="mb-3" action="{{route('login')}}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="email" class="form-label">Email or Username</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Email or Username" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror          </div>
          <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="password">Password</label>
              <a href="{{url('auth/forgot-password-cover')}}">
                <small>Forgot Password?</small>
              </a>
            </div>
            <div class="input-group input-group-merge">
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password">

              @error('password')
              <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
              @enderror
              <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
            </div>
          </div>
          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="remember-me">
              <label class="form-check-label" for="remember-me">
                Remember Me
              </label>
            </div>
          </div>
          <button class="btn btn-primary d-grid w-100" type="submit">
            Sign in
          </button>
        </form>

        <p class="text-center">
          <span>New on our platform?</span>
          <a href="{{url('/register')}}">
            <span>Create an account</span>
          </a>
        </p>

{{--        <div class="divider my-4">--}}
{{--          <div class="divider-text">or</div>--}}
{{--        </div>--}}

{{--        <div class="d-flex justify-content-center">--}}
{{--          <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">--}}
{{--            <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>--}}
{{--          </a>--}}

{{--          <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">--}}
{{--            <i class="tf-icons fa-brands fa-google fs-5"></i>--}}
{{--          </a>--}}

{{--          <a href="javascript:;" class="btn btn-icon btn-label-twitter">--}}
{{--            <i class="tf-icons fa-brands fa-twitter fs-5"></i>--}}
{{--          </a>--}}
{{--        </div>--}}
      </div>
    </div>
    <!-- /Login -->
  </div>
</div>
@endsection
