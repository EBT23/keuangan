@extends('layouts.base',['title' => "Penggajian - Admin"])
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
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @else
                    
                    @endif
                    <h4 class="card-title">FORM TAMBAH PENGGAJIAN</h4>
                    <hr>
                    <form action="{{ route('tambah_penggajian') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="bulan">Bulan</label>
                                    <input type="month" class="form-control @error('bulan') is-invalid @enderror" value="{{ old('bulan') }}" id="bulan" name="bulan"
                                        aria-describedby="bulan">
                                        @error('bulan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Nama Karyawan</label>
                                    <select class="form-control" id="nama_karyawan" name="nama_karyawan">
                                        <option value="" selected disabled>Pilih Karyawan</option>
                                        @foreach ( $users as $u )
                                        <option value="{{ $u->id }}">{{ $u->name.'-'.$u->no_identitas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kehadiran">Kehadiran</label>
                                    <input type="number" class="form-control @error('kehadiran') is-invalid @enderror" value="{{ old('kehadiran') }}" id="kehadiran" name="kehadiran"
                                        aria-describedby="kehadiran">
                                        @error('kehadiran')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="lembur">Lembur/jam</label>
                                    <input type="number" class="form-control @error('lembur') is-invalid @enderror" value="{{ old('lembur') }}" id="lembur" name="lembur"
                                        aria-describedby="lembur">
                                        @error('lembur')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="insentiv">Insentiv</label>
                                    <input type="number" class="form-control @error('insentiv') is-invalid @enderror" value="{{ old('insentiv') }}" id="insentiv" name="insentiv"
                                        aria-describedby="insentiv">
                                        @error('insentiv')
                                            <div class="text-danger">{{ $message }}</div>
                                    @enderror 
                                </div>
                                {{-- <div class="form-group">
                                    <label for="pinjaman">Pinjaman Karyawan</label>
                                    <input type="number" class="form-control" id="pinjaman" name="pinjaman"
                                        aria-describedby="pinjaman">
                                </div> --}}
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>

                    <div class="table-responsive">
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th scope="col" width="10%">No</th>
                                    <th scope="col">Priode</th>
                                    <th scope="col">Nama Karyawan</th>
                                    <th scope="col">Total Gaji</th>
                                    <th scope="col" width="15%">Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penggajian as $index =>$gj )
                            <tr>
                                {{-- <th scope="row">{{ $index+1 }}</th> --}}
                                <td>{{ $index+1}}</td>
                                <td>{{ date('Y-F',strtotime($gj->bulan)) }}</td>
                                <td>{{ $gj->name.'-'.$gj->no_identitas }}</td>
                                <td>Rp. {{ number_format($gj->total) }}</td>
                                <td class="d-flex" >
                                    <span>
                                        <a href="{{ route('detail_penggajian', $gj->id) }}"
                                        class="btn btn-outline-primary waves-effect waves-light m-md-1">Detail</a>
                                    </span>
                                    <span>
                                        <form action="{{ route('delete_penggajian', $gj->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button onclick="return confirm('Anda yakin akan menghapus ini? ')"
                                                type="submit"
                                                class="btn btn-outline-danger waves-effect waves-light mt-1">Hapus</i></button>
                                        </form>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
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
    <!--End wrapper-->
    <script>
        $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
})
    </script>