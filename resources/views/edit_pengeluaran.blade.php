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
    <div class="card-body">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Data {{ $title }}</h6>
                 <!-- Table Start -->
 <div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
        <div class="col-12">
            <div class="card mb-5">
                <div class="card-body">
                    <h4 class="card-header">EDIT DATA pengeluaran</h4>
                    <form action="{{ route('update.pengeluaran', ['id' => $pengeluaran['id']]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                 <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="jenis_pengeluaran" class="form-label">Jenis pengeluaran</label>
                        <input type="text" class="form-control" id="jenis_pengeluaran"
						value="{{ $pengeluaran['jenis_pengeluaran'] }}" name="jenis_pengeluaran"
						aria-describedby="jenis_pengeluaran" required>
                      </div>
                      <div class="mb-3">
                          <label for="keterangan" class="form-label">Keterangan</label>
                          <input type="text" class="form-control" value="{{ $pengeluaran['keterangan'] }}" name="keterangan" id="keterangan" aria-describedby="jenis_pemasukan" required>
                      </div>
                    </div>
                </div>
                      
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="tgl" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tgl"
                              value="{{ $pengeluaran['tgl'] }}" name="tgl"
                              aria-describedby="tgl" required>
                              </div>
                              <div class="mb-3">
                                <label for="total_pengeluaran" class="form-label">Total pengeluaran</label>
                                <input type="text" class="form-control" id="total_pengeluaran"
                                value="{{ $pengeluaran['total_pengeluaran'] }}" name="total_pengeluaran"
                                aria-describedby="total_pengeluaran" required>
                              </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">
                            Simpan
                          </button>
                          <a href="{{ route('pengeluaran') }}" class="btn btn-secondary mt-3">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Table End -->
            </div>
            
        </div>
    </div>
</div>
<!-- Content End -->
<!-- Button trigger modal -->

  
  
<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
    <i class="bi bi-arrow-up"></i>
</a>
</div>


@endsection