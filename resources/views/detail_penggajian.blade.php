@extends('layouts.base',['title' => "Detail Penggajian - Admin"])
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
                <h6 class="mb-4">Detail Penggajian</h6>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th scope="col" style="width: 400px;">Nama Karyawan</th>
                            <td style="width: 0px;">:</td>
                            <td>{{ $penggajian[0]->name }}</td>
                        </tr>
                        <tr>
                            <th scope="col" style="width: 400px;">No Identitas</th>
                            <td style="width: 0px;">:</td>
                            <td>{{ $penggajian[0]->no_identitas }}</td>
                        </tr>
                        <tr>
                            <th scope="col" style="width: 400px;">Gaji Pokok</th>
                            <td style="width: 0px;">:</td>
                            <td>{{ $penggajian[0]->gapok }}</td>
                        </tr>
                        <tr>
                            <th scope="col" style="width: 400px;">Uang Makan</th>
                            <td style="width: 0px;">:</td>
                            <td>{{ $penggajian[0]->makan_transport }}</td>
                        </tr>
                        <tr>
                            <th scope="col" style="width: 400px;">Uang Lembur</th>
                            <td style="width: 0px;">:</td>
                            <td>{{ $penggajian[0]->lembur }}</td>
                        </tr>
                        <tr>
                            <th scope="col" style="width: 400px;">Tunjangan Jabatan</th>
                            <td style="width: 0px;">:</td>
                            <td>{{ $penggajian[0]->tunjangan }}</td>
                        </tr>
                        <tr>
                            <th scope="col" style="width: 400px;">Insentif</th>
                            <td style="width: 0px;">:</td>
                            <td>{{ $penggajian[0]->insentiv }}</td>
                        </tr>
                        <tr>
                            <th scope="col" style="width: 400px;">Jaminan Kesehatan</th>
                            <td style="width: 0px;">:</td>
                            <td>{{ $penggajian[0]->jamkes }}</td>
                        </tr>
                        <tr>
                            <th scope="col" style="width: 400px;">Pinjaman</th>
                            <td style="width: 0px;">:</td>
                            <td>{{ $penggajian[0]->pinjaman }}</td>
                        </tr>
                        <tr>
                            <th scope="col" style="width: 400px;">Total Gaji/ Take home pay</th>
                            <td style="width: 0px;">:</td>
                            <td>{{ $penggajian[0]->total }}</td>
                        </tr>
                    </table>
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
<!--End wrapper-->
<script>
    $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
})
</script>