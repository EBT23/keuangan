@extends('layouts.base',['title' => "$title - Admin"])
<!-- Start wrapper-->

@section('content') 
<!-- Spinner Start -->

<div
    id="spinner"
    class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div
        class="spinner-border text-primary"
        style="width: 3rem; height: 3rem;"
        role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->

<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    @include('layouts.header')
    <!-- Navbar End -->
    <div class="card h-100">
        @if (Session::has('success'))
        <div class="alert alert-success mb-2">
            {{ Session::get('success') }}
        </div>
        @else
        
        @endif
        <div class="card-body">
            <h4 class="card-title">MY PROFILE</h4>
            <hr>
            <form method="POST" action="#">
                @csrf
                <div class="form-group row mb-2">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Lengkap') }}</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control " value="{{ $user->name }}" name="name"  autocomplete="current-password" readonly>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                    <div class="col-md-6">
                        <input id="email" type="text" class="form-control" value="{{ $user->email }}" autocomplete="email" readonly>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Created At') }}</label>
                    <div class="col-md-6">
                        <input id="new_password_confirmation" type="text" class="form-control" value="{{ \Carbon\Carbon::parse($user->created_at)->format('d-M-Y') }}" name="new_password_confirmation"  readonly>
                    </div>
                </div>

                {{-- <div class="form-group row mt-2">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Ganti Password') }}
                        </button>
                    </div>
                </div> --}}
            </form>
        </div>
        <!-- Content End -->
        
        @endsection
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
            <i class="bi bi-arrow-up"></i>
        </a>
        </div>
        