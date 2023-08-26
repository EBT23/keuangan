@extends('layouts.base',['title' => "Dashboard - Admin"])
<!-- Start wrapper-->
@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
                        <div class="row">
                            <form action="{{ route('cetak_laporan') }}" method="post">
                                @csrf
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="tahunSelect" class="text-light">Dari tanggal</label>
                                        <input type="date" name="dari_tanggal" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="tahunSelect" class="text-light">Sampai Tanggal</label>
                                        <input type="date" name="sampai_tanggal" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Cetak</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="form-group">
                            <label for="tahunSelect" class="text-light">Pilih Bulan</label>
                            <?php
                                    $currentYear = date('Y');
                                    $currentMonth = date('m');

                                    $monthsToShow = [];

                                    for ($year = $currentYear; $year >= 2020; $year--) {
                                        $endMonth = ($year == $currentYear) ? $currentMonth : 12;

                                        for ($month = $endMonth; $month >= 1; $month--) {
                                            $formattedDate = sprintf('%04d-%02d', $year, $month);
                                            $monthsToShow[] = $formattedDate;
                                        }
                                    }
                            ?>
                            <select class="form-control" id="tahunSelect" name="tahunSelect">
                                <option value="" selected>Total Keseluruhan</option>
                                @foreach ($monthsToShow as $month)

                                <option value="{{ $month }}">{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 col-xl-12">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-line fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p>Pemasukan</p>
                                    <h6 class="mb-0" id="pemasukan"></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xl-12">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p>Pengeluaran</p>
                                    <h6 class="mb-0" id="pengeluaran"></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xl-12">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-money-check-alt fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p>Penggajian</p>
                                    <h6 class="mb-0" id="penggajian">


                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xl-12">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-area fa-3x text-primary"></i>
                                <div class="ms-4">
                                    <p>Laba Bersih</p>
                                    <h6 class="mb-0" id="laba_bersih"></h6>
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
                    datasets: [
                        {
                            label: 'Pemasukan',
                            backgroundColor: 'rgba(0, 123, 255, 0.5)',
                            borderColor: 'rgba(0, 123, 255, 1)',
                            borderWidth: 1,
                            data: data.dataPemasukan,
                    }, 
                    {
                            label: 'Pengeluaran',
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1,
                            data: data.dataPengeluaran,
                    }
                    // {
                    //         label: 'Penggajian',
                    //         backgroundColor: 'rgba(0, 255, 46, 0.5)',
                    //         borderColor: 'rgba(0, 255, 46, 1)',
                    //         borderWidth: 1,
                    //         data: data.dataPenggajian,
                    // }
                ]},
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