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
    <div class="card-body">
        <div class="col-lg">
            <div class="bg-white rounded h-120 p-4">
                <h6 class="mb-4">Data Karyawan</h6>
                 <div class="container-fluid pt-2 px-4">
                    <form action="{{ route('update.karyawan', ['id' => $karyawan['id']]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ $karyawan['name'] }}" aria-describedby="name"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        value="{{ $karyawan['email'] }}" aria-describedby="email"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="no_identitas" class="form-label">No
                                        Identitas</label>
                                    <input type="number" class="form-control" name="no_identitas"
                                        id="no_identitas" value="{{ $karyawan['no_identitas'] }}"
                                        aria-describedby="no_identitas" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tempat_lahir" class="form-label">Tempat
                                        Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir"
                                        id="tempat_lahir" value="{{ $karyawan['tempat_lahir'] }}"
                                        aria-describedby="tempat_lahir" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tgl_lahir"
                                        name="tgl_lahir" id="tgl_lahir"
                                        value="{{ $karyawan['tgl_lahir'] }}"
                                        aria-describedby="tgl_lahir" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="no_rek" class="form-label">No Rekening</label>
                                    <input type="text" class="form-control" name="no_rek"
                                        id="no_rek" value="{{ $karyawan['no_rek'] }}"
                                        aria-describedby="no_rek" required>
                                </div>
                                <div class="mb-3">
                                    <label for="posisi_id" class="form-label">Posisi</label>
                                    <select class="form-control" name="posisi_id"
                                        data-allow-clear="true">
                                        @foreach ($posisi as $item)
                                        <option value="{{ $item['id'] }}">
                                            {{ $item['nama_posisi'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="Karyawan Tetap" {{ old('status')=='active'
                                            ? 'selected' : '' }}>Karyawan Tetap</option>
                                        <option value="Karyawan Tidak Tetap" {{
                                            old('status')=='inactive' ? 'selected' : '' }}>Karyawan
                                            Tidak Tetap</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="domisili" class="form-label">Domisili</label>
                                    <input type="text" class="form-control" name="domisili"
                                        id="domisili" value="{{ $karyawan['domisili'] }}"
                                        aria-describedby="domisili" required>
                                </div>
                                <div class="mb-3">
                                    <label for="no_tlp" class="form-label">No Handphone</label>
                                    <input type="number" class="form-control" id="no_tlp"
                                        name="no_tlp" id="no_tlp" value="{{ $karyawan['no_tlp'] }}"
                                        aria-describedby="no_tlp" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">
                            Simpan
                        </button>
                        <a href="{{ route('karyawan') }}" class="btn btn-secondary mt-3">Kembali</a>
                    </form>
            </div>
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