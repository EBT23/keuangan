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
                <h6 class="mb-4">{{ $title }}</h6>
                 <!-- Table Start -->
 <div class="container-fluid pt-4 px-4">
        <div class="col-12">
            <div class="card mb-5">
                <div class="card-body my-3">
                    <h4 class="card-title">FORM EDIT DATA DISTRIBUTOR</h4>
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
                          <label for="penjab_id" class="form-label">Penjab</label>
                          <input class="form-control" name="penjab_id"  id="penjab_id" value="{{ $distributor['penjab_id'] }}">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    Simpan
                  </button>
            </form>
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

<!--End wrapper-->
<script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
</script>
@endsection