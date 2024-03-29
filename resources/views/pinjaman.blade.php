@extends('layouts.base')
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
            <h4 class="card-title">FORM TAMBAH DATA PINJAMAN</h4>
            <hr>
            <form action="{{ route('tambah.pinjaman') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="id_users" class="form-label">Karyawan</label>
                            <select class="form-select" name="id_users" id="id_users" data-allow-clear="true">
                                <option selected="">Pilih Karyawan</option>
                                @foreach($data1 as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="pinjaman" class="form-label">Pinjaman</label>
                            <input type="number" class="form-control @error('pinjaman') is-invalid @enderror"  name="pinjaman" id="pinjaman">
                            @error('pinjaman')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror"  name="tanggal" id="tanggal">
                            @error('tanggal')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                    <div class="col-6">

                        {{-- <div class="mb-3">
                            <label for="status_pinjaman" class="form-label">Status Pinjaman</label>
                            <select class="form-select" name="status_pinjaman" id="status_pinjaman" required>
                                <option selected>Pilih Status</option>
                                <option value="1">Lunas</option>
                                <option value="0">Hutang</option>
                            </select>
                        </div> --}}
                    </div>
                </div>
                <div class="">
                    <button class="btn btn-primary" type="submit">Tambah</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @else 

                    @endif
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Data Pinjaman</h6>
                            <div class="table-responsive">
                                <table id="myTable" class="display">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Karyawan</th>
                                            <th scope="col">Pinjaman</th>
                                            <th scope="col">Tanggal</th>
                                            {{-- <th scope="col">Status</th> --}}
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $index => $sp )
                                        <tr>
                                            <th scope="row">{{ $index+1 }}</th>
                                            <td>{{ $sp->name }}</td>
                                            <td>Rp. {{ number_format($sp->pinjaman) }}</td>
                                            <td>{{ $sp->tanggal }}</td>
                                            {{-- @if($sp->status == 1)
                                            <td>Lunas</td>
                                            @else
                                            <td>Hutang</td>
                                            @endif --}}
                                            <td>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <a href="{{ route('edit.pinjaman', $sp->id) }}" type="button"
                                                        class="btn btn-outline-primary waves-effect waves-light">
                                                        Edit</a>
                                                    <form action="{{ route('delete.pinjaman', $sp->id) }}"
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

    @endsection