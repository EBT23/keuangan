<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function pemasukan()
    {
        $data['title'] = 'Laporan Pemasukan';

        $pemasukan = DB::table('pemasukan')->get();

        return view('laporanPemasukan', ['pemasukan' => $pemasukan], $data);
    }
    public function pengeluaran()
    {
        $data['title'] = 'Laporan Pengeluaran';

        $pengeluaran = DB::table('pengeluaran')->get();

        return view('laporanPengeluaran', ['pengeluaran' => $pengeluaran], $data);
    }
    public function gaji()
    {
        $data['title'] = 'Laporan Gaji';

        $gaji = DB::table('penggajian')->get();
        $users = DB::table('users')->get();

        return view('laporanGaji', ['gaji' => $gaji, 'users' => $users], $data);
    }
}
