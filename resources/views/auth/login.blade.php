@extends('auth.layouts.app-login')
<!-- start loader -->
@section('content')
<div class="container-xxl position-relative bg-white d-flex p-0">
  <!-- Spinner Start -->
  <div id="spinner"
    class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
  <!-- Spinner End -->

  <!-- Sign In Start -->
  <div class="container-fluid">

    <form action="{{ route('login') }}" method="POST">
      <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
        @csrf
        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-5">
          <div>
            @if (Session::has('success'))
            <div class="alert alert-success">
              {{ Session::get('success') }}
            </div>
            @else
            @endif
          </div>
          <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3 card shadow">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div>
                <a href="{{ route('login') }}">
                  <img src="{{ asset('img/logo-pvc.png') }}" alt="" height="100" width="100" srcset="">
                </a>
              </div>
              <h3 class="text-center">PT. Panorama Varia Cipta</h3>
            </div>
            <div class="form-floating mb-3">
              <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" id="email" placeholder="name@example.com">
              <label for="email">Email address</label>
              @error('email')
                    <div class="text-danger">{{ $message }}</div>
              @enderror 
            </div>
            <div class="form-floating mb-4">
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
              <label for="password">Password</label>
              @error('password')
                    <div class="text-danger">{{ $message }}</div>
              @enderror 
            </div>
            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">{{ __('Login') }}</button>
          </div>
        </div>

      </div>
    </form>
  </div>
  <!-- Sign In End -->
</div>
@endsection