<?php

namespace App\Http\Controllers;

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
// dd($pemasukan);
            return view('index',compact('pemasukan', 'pengeluaran', 'laba_bersih'));
        }
}