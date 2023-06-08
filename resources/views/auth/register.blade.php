@extends('auth.layouts.app-register')

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

    <!-- Sign Up Start -->
    <div class="container-fluid">
      <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
          <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
              <div class="d-flex align-items-center justify-content-between my-2">
                              <h3>Sign Up</h3>
            </div>
            <div class="form-floating my-2">
                <input type="text" class="form-control" id="nama" name="nama">
                <label for="nama">nama</label>
            </div>
            <div class="form-floating my-2">
                <input type="email" class="form-control" id="email" name="email">
                <label for="email">Email</label>
            </div>
            <div class="form-floating my-2">
                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
                <label for="tgl_lahir" nam>Tanggal Lahir</label>
            </div>
            <div class="form-floating my-2">
                <select class="form-select" id="posisi" name="posisi" aria-label="Floating label select example">
                  <option selected>-Pilih-</option>
                  @foreach ($posisi as $d)
                    <option value="{{ $d->id }}">{{ $d->nama_posisi }}</option>
                  @endforeach
                </select>
                <label for="posisi">Pilih Posisi</label>
              </div>
              <div class="form-floating mb-4">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                <label for="password" >Password</label>
            </div>

              <div class="d-flex align-items-center justify-content-between mb-2">
                        <a href="">Forgot Password</a>
              </div>
              <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
              <p class="text-center mb-0">Already have an Account? <a href="{{ route('login') }}">Sign In</a></p>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- Sign Up End -->
  </div>
@endsection
