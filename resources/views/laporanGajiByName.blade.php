@extends('layouts.base')
<!-- Start wrapper-->

@section('content')
<!-- Spinner Start -->

<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
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
            <h4 class="card-title">FORM LAPORAN DATA GAJI</h4>
            <hr>
            
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
                            <h6 class="mb-4">Data Jenis Gaji</h6>
                            <div class="table-responsive">
                                <table id="myTable" class="display">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="5%">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Tahun&Bulan</th>
                                            <th scope="col">Gaji Pokok</th>
                                            <th scope="col">Makan & Transport</th>
                                            <th scope="col" width="15%">Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($gaji as $index => $pm )
                                        <tr>
                                            <th scope="row">{{ $index+1 }}</th>
                                            <td>{{ $pm->name }}</td>
                                            <td>{{ $pm->bulan }}</td>
                                            <td>{{ $pm->gapok }}</td>
                                            <td>{{ $pm->makan_transport }}</td>
                                            <td>
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <a href="/gaji/cetakById/{{ $pm->id }}"
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
               
                $.ajax({
                    url: "/gaji/cetak",
                    type: "GET",
                    data: {
                        bulan:  $('#bulan').val(),
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