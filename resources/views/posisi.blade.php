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
    <div class="card">

        <div class="card-body">
            <h4 class="card-title">FORM TAMBAH DATA POSISI</h4>
            <hr>
        <form action="{{ route('tambah.posisi') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="row">
             <div class="col-6">
              <div class="mb-3">
                <label for="nama_posisi" class="form-label">Posisi</label>
                <input  type="text" class="form-control @error('nama_posisi') is-invalid @enderror"" name="nama_posisi" id="nama_posisi">
                @error('nama_posisi')
                <div class="text-danger">{{ $message }}</div>
              @enderror 
              </div>
            </div>
            </div>
                <button type="submit" class="btn btn-primary">
                    Tambah
                </button>
        </form>
        </div>
        <div class="card-body">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @else
                    
                    @endif
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Data Posisi</h6>
                            <div class="table-responsive">
                                <table id="myTable" class="display">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="10%">No</th>
                                            <th scope="col">Posisi</th>
                                            <th scope="col" width="20%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posisi as $index => $ps )
                                        <tr>
                                            <th scope="row">{{ $index+1 }}</th>
                                            <td>{{ $ps['nama_posisi'] }}</td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <a href="{{ route('edit.posisi', ['id' => $ps['id']]) }}" type="button"
                                                        class="btn btn-outline-primary waves-effect waves-light">
                                                        Edit</a>
                                                        <form action="{{ route('delete.posisi', ['id' => $ps['id']]) }}" method="POST">
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
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
<!-- Content End -->

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
    <i class="bi bi-arrow-up"></i>
</a>
</div>

@endsection
