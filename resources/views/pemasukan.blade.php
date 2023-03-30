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
                    <h4 class="card-title">FORM TAMBAH DATA PEMASUKAN</h4>
                    <form action="{{ route('tambah.pemasukan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="jenis_pemasukan" class="form-label">Jenis Pemasukan</label>
                        <input class="form-control" name="jenis_pemasukan" id="jenis_pemasukan">
                      </div>
                      <div class="mb-3">
                          <label for="keterangan" class="form-label">Keterangan</label>
                          <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
                      </div>
                        <div class="mb-3">
                          <label for="tgl" class="form-label">Tanggal</label>
                          <input type="date" class="form-control" name="tgl" id="tgl">
                        </div>
                        <div class="mb-3">
                          <label for="total_pemasukan" class="form-label">Total Pemasukan</label>
                          <input class="form-control" name="total_pemasukan" id="total_pemasukan">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Tambah
                          </button>
                        </div>
                        </div>
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
                                <th scope="col">Jenis Pemasukan</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Total Pemasukan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemasukan as $index => $pm)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $pm['jenis_pemasukan'] }}</td>
                                        <td>{{ $pm['keterangan'] }}</td>
                                        <td>{{ $pm['tgl'] }}</td>
                                        <td>Rp. {{ number_format($pm['total_pemasukan']) }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <a href="{{ route('edit.pemasukan', ['id' => $pm['id']]) }}" type="button"
                                                    class="btn btn-outline-primary waves-effect waves-light">
                                                    Edit</a>
                                                   <form action="{{ route('delete.pemasukan', ['id' => $pm['id']]) }}" method="POST">
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