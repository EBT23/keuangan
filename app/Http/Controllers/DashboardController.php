<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
        public function index()
        {
            $pemasukan = DB::select('SELECT SUM(total_pemasukan) As jumlah_pemasukan FROM pemasukan');
            $pemasukan = $pemasukan[0];
            $pemasukan = $pemasukan->jumlah_pemasukan;

            $pengeluaran = DB::select('SELECT SUM(total_pengeluaran) As jumlah_pengeluaran FROM pengeluaran');
            $pengeluaran = $pengeluaran[0];
            $pengeluaran = $pengeluaran->jumlah_pengeluaran;

            $laba_bersih = $pemasukan - $pengeluaran;

            $getPemasukan = Pemasukan::selectRaw('SUM(total_pemasukan) as total_pemasukan, MONTH(tgl)  as month, YEAR(tgl) as year ')
                ->groupBy('month','year')
                ->orderBy('year')
                ->orderBy('month')
                ->get();

            $getPengeluaran = Pengeluaran::selectRaw('SUM(total_pengeluaran) as total_pengeluaran, MONTH(tgl) as month, YEAR(tgl) as year')
                ->groupBy('month','year')
                ->orderBy('year')
                ->orderBy('month')
                ->get();

            $labels = $getPemasukan->map(function($item) {
                return Carbon::createFromDate($item->year, $item->month, 1)->format('F Y');
            });
            $dataPemasukan = $getPemasukan->pluck('total_pemasukan');
            $dataPengeluaran = $getPengeluaran->pluck('total_pengeluaran');

            $data = [
                'labels' => $labels,
                'dataPemasukan' => $dataPemasukan,
                'dataPengeluaran' => $dataPengeluaran,
            ];

            return view('index',compact('pemasukan', 'pengeluaran', 'laba_bersih','data'));
        }

}