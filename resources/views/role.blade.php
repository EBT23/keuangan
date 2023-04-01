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
            <h4 class="card-title">FORM TAMBAH DATA ROLE</h4>
            <hr>
        <form action="{{ route('tambah.role') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="row">
             <div class="col-6">
              <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <input type="text" class="form-control" name="role" id="role">
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
                    @elseif (Session::has('errors'))
                    <div class="alert alert-danger">
                        {{ Session::get('errors') }}
                    </div>
                    @endif
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Data Role</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($role as $index => $rl )
                                        <tr>
                                            <th scope="row">{{ $index+1 }}</th>
                                            <td>{{ $rl['role'] }}</td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <a href="" type="button"
                                                        class="btn btn-outline-primary waves-effect waves-light">
                                                        Edit</a>
                                                        <form action="" method="POST">
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
