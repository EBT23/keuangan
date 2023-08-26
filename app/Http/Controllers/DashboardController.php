<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Penggajian;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
        public function index()
        {
            $tanggal = DB::select("SELECT DISTINCT date_format(pengeluaran.tgl, '%Y-%m') as tanggal FROM `pengeluaran` ORDER BY date_format(pengeluaran.tgl, '%Y-%m') ASC");

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

            $getPenggajian = Penggajian::selectRaw('SUM(total) as total_penggajian, MONTH(bulan) as month')
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            $labels = $getPemasukan->map(function($item) {
                return Carbon::createFromDate($item->year, $item->month, 1)->format('F Y');
            });
            $dataPenggajian = $getPenggajian->pluck('total_penggajian');
            $dataPemasukan = $getPemasukan->pluck('total_pemasukan');
            $dataPengeluaran = $getPengeluaran->pluck('total_pengeluaran');

            $data = [
                'labels' => $labels,
                'dataPemasukan' => $dataPemasukan,
                'dataPengeluaran' => $dataPengeluaran,
                'dataPenggajian' => $dataPenggajian,
            ];

            return view('index',compact('data', 'tanggal'));
        }

        public function getDataAll()  {
            $pemasukan = DB::select('SELECT SUM(total_pemasukan) As jumlah_pemasukan FROM pemasukan');
            $pemasukan = $pemasukan[0];
            $pemasukan = $pemasukan->jumlah_pemasukan;

            $pengeluaran = DB::select('SELECT SUM(total_pengeluaran) As jumlah_pengeluaran FROM pengeluaran');
            $pengeluaran = $pengeluaran[0];
            $pengeluaran = $pengeluaran->jumlah_pengeluaran;

            $penggajian = DB::select('SELECT SUM(total) As total FROM penggajian');
            $penggajian = $penggajian[0];
            $penggajian = $penggajian->total;

            $laba_bersih = $pemasukan - $pengeluaran;

            $data1 = [
                'pemasukan' => $pemasukan, // Ganti dengan data yang sesuai
                'pengeluaran' => $pengeluaran, // Ganti dengan data yang sesuai
                'penggajian' => $penggajian, // Ganti dengan data yang sesuai
                'laba_bersih' => $laba_bersih, // Ganti dengan data yang sesuai
            ];
            
            return response()->json($data1);
        }

        public function getDataByYear($bulan_tahun)
        {
            // Lakukan perhitungan atau manipulasi data untuk menampilkan data dari semua bulan
            // Misalnya, dapatkan pemasukan, pengeluaran, dan penggajian dari semua bulan
            $pemasukan = DB::select("SELECT SUM(total_pemasukan) As jumlah_pemasukan FROM pemasukan WHERE date_format(pemasukan.tgl, '%Y-%m') = '$bulan_tahun'");
            
            $pemasukan = $pemasukan[0];
            $pemasukan = $pemasukan->jumlah_pemasukan;
            $pemasukan;

            $pengeluaran = DB::select("SELECT SUM(total_pengeluaran) As jumlah_pengeluaran FROM pengeluaran WHERE date_format(pengeluaran.tgl, '%Y-%m') = '$bulan_tahun'");
            $pengeluaran = $pengeluaran[0];
            $pengeluaran = $pengeluaran->jumlah_pengeluaran;

            $penggajian = DB::select("SELECT SUM(total) As total FROM penggajian WHERE date_format(penggajian.created_at, '%Y-%m') = '$bulan_tahun'");
            $penggajian = $penggajian[0];
            $penggajian = $penggajian->total;
            $laba_bersih = $pemasukan - $pengeluaran;
            $data1 = [
                'pemasukan' => $pemasukan, // Ganti dengan data yang sesuai
                'pengeluaran' => $pengeluaran, // Ganti dengan data yang sesuai
                'penggajian' => $penggajian, // Ganti dengan data yang sesuai
                'laba_bersih' => $laba_bersih, // Ganti dengan data yang sesuai
            ];

            return response()->json($data1);
        }

        public function profile()
        {   
            $data['title'] = 'My Profile';

            $posisi = DB::table('posisi')->get();
            $user = Auth::user();

            return view('auth.profile', compact('user','posisi'), $data);
        }

        public function updateProfile(Request $request, $id)
        {
            $user = Auth::user();
    
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'no_identitas' => 'required',
                'tgl_lahir' => 'required',
                'no_tlp' => 'required',
            ]);
    
            DB::table('users')
                ->where('id', $id)
                ->update([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'no_identitas' => $validatedData['no_identitas'],
                    'tgl_lahir' => $validatedData['tgl_lahir'],
                    'no_tlp' => $validatedData['no_tlp'],
            ]);
    
            return redirect()
                ->route('profile')
                ->with('success', 'Profil berhasil diperbarui.');
        }
    }
