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
    <div class="card">
    <div class="card-body">
        <div class="col-lg">
                            <h4 class="card-title">Data Pengeluaran</h4>
                            <hr>
                            <form action="{{ route('update.pengeluaran', $pengeluaran->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="mb-3">
                                            <label for="jenis_pengeluaran_id" class="form-label">Jenis
                                                Pengeluaran</label>
                                            <select class="form-select" name="jenis_pengeluaran_id"
                                                data-allow-clear="true">
                                                <option value="" selected disabled>Jenis Pengeluaran:</option>
                                                @foreach ($jenis_pengeluaran as $item)
                                                <option @if($pengeluaran->jenis_pengeluaran_id == $item->id) selected @endif value="{{ $item->id }}">{{ $item->jenis_pengeluaran}}</option> 
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="keterangan" class="form-label">Keterangan</label>
                                            <input type="text" class="form-control"
                                                value="{{ $pengeluaran['keterangan'] }}" name="keterangan"
                                                id="keterangan" aria-describedby="jenis_pengeluaran"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tgl" class="form-label">Tanggal</label>
                                            <input type="date" class="form-control" id="tgl"
                                                value="{{ $pengeluaran['tgl'] }}" name="tgl"
                                                aria-describedby="tgl" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="total_pengeluaran" class="form-label">Total
                                                Pengeluaran</label>
                                            <input type="text" class="form-control" id="total_pengeluaran"
                                                value="{{ $pengeluaran['total_pengeluaran'] }}"
                                                name="total_pengeluaran"
                                                aria-describedby="total_pengeluaran" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="bukti_pengeluaran" class="form-label">Bukti
                                                Pengeluaran</label> 
                                            <input type="file" class="form-control" id="bukti_pengeluaran"
                                                value="{{ $pengeluaran['bukti_pengeluaran'] }}"
                                                name="bukti_pengeluaran"
                                                aria-describedby="bukti_pengeluaran" required>
                                                <img class="mt-1" src="{{ asset('upload/pengeluaran/' . $pengeluaran->bukti_pengeluaran . '') }}" alt="Bukti Pengeluaran Sebelumnya" height="80" width="80">
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3">
                                            Simpan
                                        </button>
                                        <a href="{{ route('pengeluaran') }}"
                                            class="btn btn-secondary mt-3">Kembali</a>
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