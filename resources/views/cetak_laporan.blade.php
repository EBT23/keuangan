<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
        }

        .report-container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        .report-title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .table {
            width: 98.2%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <div class="report-container">
        <h1 style="text-align: center">Laporan Keuangan PT. Panorama Varia Cipta</h1>
        <p class="report-title">Tanggal {{ $dari_tanggal }} - {{ $sampai_tanggal }}</p>

        <h2>Pemasukan</h2>
        <table class="table">
            <tr>
                <th>No</th>
                <th>Distributor</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
                <th>Total Pemasukan</th>
            </tr>
            <!-- Loop through your income data and populate the rows -->
            <?php $total_pemasukan = []; ?>
            @foreach ( $pemasukan as $index => $p )
            <tr>
                <td>{{ $index+=1 }}</td>
                <td>{{ $p->nama_distributor }}</td>
                <td>{{ $p->keterangan }}</td>
                <td>{{ $p->tgl }}</td>
                <td>Rp. {{ $p->total_pemasukan }}</td>
                <?php  array_push($total_pemasukan,$p->total_pemasukan) ?>
            </tr>
            @endforeach
            <tr>
                <td colspan="4">Total : </td>
                <td>Rp. {{ array_sum($total_pemasukan) }}</td>
            </tr>
            <!-- Repeat for other income rows -->
        </table>

        <h2>Pengeluaran</h2>
        <table class="table">
            <tr>
                <th>NO</th>
                <th>Jenis Pengeluaran</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
                <th>Total Pengeluaran</th>
            </tr>
            <!-- Loop through your expense data and populate the rows -->
            <?php $total_pengeluaran = []; ?>
            @foreach ($pengeluaran as $index => $p )
            <tr>
                <td>{{ $index+=1 }}</td>
                <td>{{ $p->jenis_pengeluaran }}</td>
                <td>{{ $p->keterangan }}</td>
                <td>{{ $p->tgl }}</td>
                <td>Rp. {{ $p->total_pengeluaran }}</td>
                <?php  array_push($total_pengeluaran,$p->total_pengeluaran) ?>
            </tr>
            @endforeach
            <tr>
                <td colspan="4">Total : </td>
                <td>Rp. {{ array_sum($total_pengeluaran) }}</td>
            </tr>
            <!-- Repeat for other expense rows -->
        </table>
        <h2>Laba Bersih</h2>
        <table class="table">
            <tr>
                <th>Total Pemasukan</th>
                <td>Rp. {{ array_sum($total_pemasukan) }}</td>
            </tr>
            <tr>
                <th>Total Pengeluaran</th>
                <td>Rp. {{ array_sum($total_pengeluaran) }}</td>

            </tr>
            <tr>
                <th>Laba Bersih</th>
                <td>Rp. {{ (array_sum($total_pengeluaran)) - array_sum($total_pemasukan) }}
                </td>
            </tr>
            <!-- Repeat for other payroll rows -->
        </table>
    </div>
    <script>
        window.print()
    </script>

</body>

</html>