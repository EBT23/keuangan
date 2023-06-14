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
                            <h4 class="card-title">Data Distributor</h4>
                            <hr>
                            <form action="{{ route('update.distributor',['id' => $distributor['id']]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="nama_distributor" class="form-label">Nama Distributor</label>
                                    <input class="form-control" name="nama_distributor" id="nama_distributor" value="{{ $distributor['nama_distributor'] }}">
                                </div>
                                <div class="mb-3">
                                    <label for="tlp" class="form-label">No Telepon</label>
                                    <input type="number" class="form-control" name="tlp" id="tlp" value="{{ $distributor['tlp'] }}">
                                </div>
                                <div class="mb-3">
                                <label for="area_cover" class="form-label">Area Cover</label>
                                <input type="text" class="form-control" name="area_cover" id="area_cover" value="{{ $distributor['area_cover'] }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" name="alamat"  id="alamat" >{{ $distributor['alamat'] }}</textarea>
                                </div>
                                <div class="mb-3">
                                  <label for="penjab" class="form-label">Penjab</label>
                                  <input class="form-control" name="penjab"  id="penjab" value="{{ $distributor['penjab'] }}">
                                </div>
                            </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">
                            Simpan
                            </button>
                            <a href="{{ route('distributor') }}" class="btn btn-secondary mt-3">Kembali</a>
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