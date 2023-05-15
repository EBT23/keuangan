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
                <h4 class="card-title">FORM LAPORAN DATA JENIS PEMASUKAN</h4>
                <hr>
                <form action="{{ route('pemasukan.search') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="StartDate" class="form-label">Dari Tanggal</label>
                                <input type="date" class="form-control" name="StartDate" id="StartDate"
                                    value="{{ $StartDate }}" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="EndDate" class="form-label">Sampai Tanggal</label>
                                <input type="date" class="form-control" name="EndDate" id="EndDate"
                                    value="{{ $EndDate }}" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit" style="margin-top: 31px;">Filter</button>
                                @if ($StartDate != '')
                                    <a onclick="sendexcel()" class="btn btn-success" style="margin-top: 31px;">Cetak</a>
                                    <a href="/laporan/pemasukan" class="btn btn-danger" type="submit"
                                        style="margin-top: 31px;">Reset</a>
                                @endif

                            </div>
                        </div>
                    </div>

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
                                <h6 class="mb-4">Data Jenis Pengeluaran</h6>
                                <div class="table-responsive">
                                    <table id="myTable" class="display">
                                        <thead>
                                            <tr>
                                                <th scope="col" width="5%">No</th>
                                                <th scope="col">Distributo</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Nilai</th>
                                                <th scope="col" width="15%">Aksi</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pemasukan as $index => $pm)
                                                <tr>
                                                    <th scope="row">{{ $index + 1 }}</th>
                                                    <td>{{ $pm->nama_distributor }}</td>
                                                    <td>{{ $pm->keterangan }}</td>
                                                    <td>{{ $pm->tgl }}</td>
                                                    <td>{{ $pm->total_pemasukan }}</td>
                                                    <td>
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <a href="/pemasukan/cetakById/{{ $pm->id }}"
                                                                class="btn btn-success">Cetak</a>
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
            function sendexcel() {
                var StartDate = $('#StartDate').val();
                var EndDate = $('#EndDate').val();
                console.log(StartDate);
                $.ajax({
                    url: "/pemasukan/cetak",
                    type: "GET",
                    data: {
                        StartDate: StartDate,
                        EndDate: EndDate,
                    },
                    success: function(response) {
                        console.log(response);
                         window.open(this.url,'_blank' );
                        // document.getElementById("total_items").value = response;
                        // document.getElementById("disp").innerHTML = response;
                    },
                    error: function() {
                        alert("error");
                    }
                });
            }
        </script>
    @endsection
