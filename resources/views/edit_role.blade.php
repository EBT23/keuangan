@extends('layouts.base',['title' => "Dashboard - Admin"])
<!-- Start wrapper-->
@section('content') 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!-- Spinner Start -->

<div id="spinner"
    class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->

<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    @include('layouts.header')
    <!-- Navbar End -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <div class="card h-100">
    <div class="card-body ">
        <div class="col-lg">
                            <h4 class="card-title">Data Role</h4>
                            <hr>
                            <form action="{{ route('update.role', ['id' => $role['id']]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                <div class="col-lg">
                              <div class="mb-3">
                                <label for="role" class="form-label">Nama Role</label>
                                <input type="text" class="form-control" id="role"
                                value="{{ $role['role'] }}" name="role"
                                aria-describedby="role" required>
                              </div>
                                <button type="submit" class="btn btn-primary mt-3">
                                    Simpan
                                  </button>
                                  <a href="{{ route('role') }}" class="btn btn-secondary mt-3">Kembali</a>
                                </div>
                                </div>
                            </form>
</div>
<!-- Content End -->
<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
    <i class="bi bi-arrow-up"></i>
</a>
</div>

@endsection
<!--End wrapper-->
<script>
$('#myModal').on('shown.bs.modal', function () {
$('#myInput').trigger('focus')
})
</script>