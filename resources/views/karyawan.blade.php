@extends('layouts.base',['title' => "$title - Admin"])
<!-- Start wrapper-->

@section('content')
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
    <div class="card">

        <div class="card-body">
            <h4 class="card-title">FORM TAMBAH DATA KARYAWAN</h4>
            <hr>
            <form action="{{ route('tambah.karyawan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_identitas" class="form-label">No Identitas</label>
                            <input type="number" class="form-control" name="no_identitas" id="no_identitas" required>
                        </div>
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <textarea class="form-control" name="tempat_lahir" id="tempat_lahir" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" id="tgl_lahir" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="no_rek" class="form-label">No Rekening</label>
                            <input type="text" class="form-control" name="no_rek" id="no_rek" required>
                        </div>
                        <div class="mb-3">
                            <label for="posisi_id" class="form-label">Posisi</label>
                            <select class="form-select" name="posisi_id" data-allow-clear="true" required>
                                <option selected="">Pilih Posisi</option>
                                @foreach ($posisi as $item)
                                <option value="{{ $item['id'] }}">
                                    {{ $item['nama_posisi'] }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" data-allow-clear="true" required>
                                <option selected="">Status :</option>
                                <option value="Karyawan Tetap" {{ old('status')=='active' ? 'selected' : '' }}>Karyawan
                                    Tetap</option>
                                <option value="Karyawan Tidak Tetap" {{ old('status')=='inactive' ? 'selected' : '' }}>
                                    Karyawan Tidak Tetap</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="domisili" class="form-label">Domisili</label>
                            <textarea class="form-control" name="domisili" id="domisili" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="no_tlp" class="form-label">No Handphone</label>
                            <input type="number" class="form-control" id="no_tlp" name="no_tlp" id="no_tlp" required>
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
                            <h6 class="mb-4">Data Karyawan</h6>
                            <div class="table-responsive">
                                <table id="myTable" class="display">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">No Identitas</th>
                                            <th scope="col">Nama Lengkap</th>
                                            <th scope="col">Posisi</th>
                                            <th scope="col">Tempat Lahir</th>
                                            <th scope="col">Tanggal Lahir</th>
                                            <th scope="col">No Handphone</th>
                                            <th scope="col">Domisili</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($karyawan as $index => $kr )
                                        <tr>
                                            <th scope="row">{{ $index+1 }}</th>
                                            <td>{{ $kr['no_identitas'] }}</td>
                                            <td>{{ $kr['name'] }}</td>
                                            <td>{{ $kr['nama_posisi'] }}</td>
                                            <td>{{ $kr['tempat_lahir'] }}</td>
                                            <td>{{ $kr['tgl_lahir'] }}</td>
                                            <td>{{ $kr['no_tlp'] }}</td>
                                            <td>{{ $kr['domisili'] }}</td>
                                            <td>{{ $kr['status'] }}</td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <a href="{{ route('edit.karyawan', ['id' => $kr['user_id']]) }}"
                                                        type="button"
                                                        class="btn btn-outline-primary waves-effect waves-light">
                                                        Edit</a>
                                                    <form action="{{ route('delete.karyawan', ['id' => $kr['id']]) }}"
                                                        method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button
                                                            onclick="return confirm('Anda yakin akan menghapus ini? ')"
                                                            type="submit"
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

    <script>
        let table = new DataTable('#myTable');
    </script>
    @endsection