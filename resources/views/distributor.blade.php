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
                 @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            @elseif (Session::has('errors'))
            <div class="alert alert-danger">
                {{ Session::get('errors') }}
            </div>
            @endif
 <div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl">
        <div class="col-12">
            <div class="card mb-5">
                <div class="card-body">
                    <h4 class="card-title">FORM TAMBAH DATA DISTRIBUTOR</h4>
                    <hr>
                    <form action="{{ route('tambah.distributor') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="nama_distributor" class="form-label">Nama Distributor</label>
                            <input class="form-control" name="nama_distributor" id="nama_distributor">
                        </div>
                        <div class="mb-3">
                            <label for="tlp" class="form-label">No Telepon</label>
                            <input type="number" class="form-control" name="tlp" id="tlp">
                        </div>
                        <div class="mb-3">
                          <label for="area_cover" class="form-label">Area Cover</label>
                          <input type="text" class="form-control" name="area_cover" id="area_cover">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat"  id="alamat"></textarea>
                        </div>
                        <div class="mb-3">
                          <label for="penjab_id" class="form-label">Penjab</label>
                          <input class="form-control" name="penjab_id"  id="penjab_id">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    Tambah
                  </button>
                    </form>
                </div>
            </div>
           
            <div class="card shadow">
                <div class="card-body">
              <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Data Pemasukan</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Distributor</th>
                                <th scope="col">Telepon</th>
                                <th scope="col">Area Cover</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Penjab</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($distributor as $index => $dt)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $dt['nama_distributor'] }}</td>
                                        <td>{{ $dt['tlp'] }}</td>
                                        <td>{{ $dt['area_cover'] }}</td>
                                        <td>{{ $dt['alamat'] }}</td>
                                        <td>{{ $dt['nama_penjab'] }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <a href="" type="button"
                                                    class="btn btn-outline-primary waves-effect waves-light">
                                                    Edit</a>
                                                   <form action="{{ route('delete.distributor', ['id' => $dt['id']]) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button onclick="return confirm('Anda yakin akan menghapus ini? ')" type="submit"
                                                    class="btn btn-outline-danger waves-effect waves-light">Hapus</i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                        </tbody>
                    </table>
                </div>
            </div>
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

<!--End wrapper-->
<script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
</script>
@endsection