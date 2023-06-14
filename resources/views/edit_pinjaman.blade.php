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
                            <h4 class="card-title">Data Pinjaman</h4>
                            <hr>
                            <form action="{{ route('update.pinjaman', ['id' => $pinjaman->id]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="mb-3">
                                            <label for="karyawan" class="form-label">Nama Karyawan</label>
                                            <select class="form-select" name="karyawan"
                                                aria-label="Default select example" required>
                                                <option value="" selected disabled>Pilih Karyawan</option>
                                                @foreach($karyawan as $item)
                                                <option {{ $item->id==$pinjaman->id_users ? 'selected' : ''
                                                    }}
                                                    value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pinjaman" class="form-label">Pinjaman</label>
                                            <input type="text" class="form-control" id="pinjaman"
                                                name="pinjaman" value="{{ $pinjaman->pinjaman }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal" class="form-label">Tanggal</label>
                                            <input type="text" class="form-control" id="tanggal"
                                                name="tanggal" value="{{ $pinjaman->tanggal }}">
                                        </div>
                                        {{-- <div class="mb-3">
                                            <label for="status_pinjaman" class="form-label">Status</label>
                                            <select class="form-select" name="status_pinjaman"
                                                id="status_pinjaman">
                                                <option value="" selected disabled>Pilih Status</option>
                                                <option {{ $pinjaman->status == 1 ? 'selected' : '' }}
                                                    value="1">Lunas</option>
                                                <option {{ $pinjaman->status == 0 ? 'selected' : '' }}
                                                    value="0">Hutang</option>
                                            </select>
                                        </div> --}}
                            
                                        <button type="submit" class="btn btn-primary mt-3">
                                            Simpan
                                        </button>
                                        <a href="{{ route('pinjaman') }}"
                                            class="btn btn-secondary mt-3">Kembali</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- Content End -->
                        <!-- Back to Top -->
                    </div>
                    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
                        <i class="bi bi-arrow-up"></i>
                    </a>
                
@endsection
                    <!--End wrapper-->
                    <script>
                        $('#myModal').on('shown.bs.modal', function () {
                            $('#myInput').trigger('focus')
                        })
                        </script>