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
                            <h4 class="card-title">Data Pemasukan</h4>
                            <hr>
                            <form action="{{ route('update.pemasukan', $pemasukan->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="mb-3">
                                            <label for="distributor_id" class="form-label">Nama
                                                Distributor</label>
                                            <select class="form-select" name="distributor_id"
                                                data-allow-clear="true">
                                                <option value="" selected disabled>Pilih Distributor</option>
                                                @foreach ($distributor as $item)
                                                    <option @if($pemasukan->distributor_id == $item->id) selected @endif value="{{ $item->id }}">{{ $item->nama_distributor}}</option>   
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="keterangan" class="form-label">Keterangan</label>
                                            <input type="text" class="form-control"
                                                value="{{ $pemasukan['keterangan'] }}" name="keterangan"
                                                id="keterangan" aria-describedby="jenis_pemasukan" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tgl" class="form-label">Tanggal</label>
                                            <input type="date" class="form-control" id="tgl"
                                                value="{{ $pemasukan['tgl'] }}" name="tgl"
                                                aria-describedby="tgl" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="total_pemasukan" class="form-label">Total
                                                Pemasukan</label>
                                            <input type="text" class="form-control" id="total_pemasukan"
                                                value="{{ $pemasukan['total_pemasukan'] }}"
                                                name="total_pemasukan" aria-describedby="total_pemasukan"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                           
                                            <label for="bukti_pemasukan" class="form-label">Bukti
                                                Pemasukan</label>
                                            <input type="file" class="form-control" id="bukti_pemasukan"
                                                value="{{ $pemasukan['bukti_pemasukan'] }}"
                                                name="bukti_pemasukan" aria-describedby="bukti_pemasukan"
                                                required>
                                                <img class="mt-1" src="{{ asset('upload/pemasukan/' . $pemasukan->bukti_pemasukan . '') }}" alt="Bukti Pemasukan Sebelumnya" height="80" width="80">
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3">
                                            Simpan
                                        </button>
                                        <a href="{{ route('pemasukan') }}"
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