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
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Responsive Table</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Jenis Pengeluaran</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Total Pengeluaran</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Aksi</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengeluaran as $d )
                                        
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{ $d['jenis_pengeluaran'] }}</td>
                                        <td>{{ $d['keterangan'] }}</td>
                                        <td>{{ $d['total_pengeluaran'] }}</td>
                                        <td>{{ $d['tgl'] }}</td>
                                          
                                        <td>Member</td>
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