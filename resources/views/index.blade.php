@extends('layouts.base',['title' => "Dashboard - Admin"])
<!-- Start wrapper-->
<<<<<<< HEAD
@section('content') 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
=======

@section('content')
>>>>>>> 6207b2e3ccc0e884559136b00350ae0302cafabe
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <div class="card-body">
        <div class="col-12">
            <div class="bg-secondary rounded h-120 p-4">
                <h6 class="mb-4 text-white">Data Dashboard</h6>
                 <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-4">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2"> Jumlah Pemasukan</p>
                                <h6 class="mb-0">Rp. {{ number_format($pemasukan) }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Jumlah Pengeluaran</p>
                                <h6 class="mb-0">Rp. {{ number_format($pengeluaran) }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Laba Bersih</p>
                                <h6 class="mb-0">Rp. {{ number_format($laba_bersih) }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl mt-3">
                        <div class="bg-light rounded p-4">
                            <h6 class="mb-4 text-center">Grafik Pemasukan & Pengeluaran</h6>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
                
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var data = @json($data);

            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Pemasukan',
                        backgroundColor: 'rgba(0, 123, 255, 0.5)',
                        borderColor: 'rgba(0, 123, 255, 1)',
                        borderWidth: 1,
                        data: data.dataPemasukan,
                    }, {
                        label: 'Pengeluaran',
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        data: data.dataPengeluaran,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        },
                        x: {
                            stacked: true,
                            title: {
                                display: true,
                                text: 'Bulan'
                            }
                        }
                    },
                    indexAxis: 'x' // Set 'x' untuk mengubah orientasi grafik berdasarkan bulan
                }
            });
        });
    </script>
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