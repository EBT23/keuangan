<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggajianController extends Controller
{
    public function penggajian()
    {
        // $data['title'] = 'Penggajian';
        
        $users = DB::table('users')
                ->where('role_id', '=', 2)
                ->get();
        
        $penggajian = DB::select('SELECT penggajian.*, users.name, users.posisi_id, users.no_identitas FROM penggajian, users WHERE penggajian.id_users =  users.id');
                
        return view('penggajian', ['users'=> $users], ['penggajian'=> $penggajian]);
    }
    public function tambah_penggajian(Request $request)
    {
        $request->validate([
            'bulan' => 'required',
            'lembur' => 'required',
            'insentiv' => 'required',
            'kehadiran' => 'required',
        ]);

        $bulan = $request->bulan;
        $nama_karyawan = $request->nama_karyawan;
        $jam_lembur = $request->lembur;
        $insentif = $request->insentiv;
        $kehadiran = $request->kehadiran;
        // $pinjaman= $request->pinjaman;
        
        $pinjaman = DB::select("SELECT SUM(pinjaman.pinjaman) AS jml_pinjaman FROM `pinjaman` WHERE id_users = $nama_karyawan AND pinjaman.status = 0");
        $pinjaman =$pinjaman[0];
        $pinjaman = $pinjaman->jml_pinjaman;
        $users = DB::table('pengaturan_gaji')
                ->join('users', 'users.id', '=', 'pengaturan_gaji.id_user')
                ->join('posisi', 'posisi.id', '=', 'users.posisi_id')
                ->select('pengaturan_gaji.*', 'users.name', 'posisi.nama_posisi', 'users.no_identitas')
                ->where('role_id', '=', 2)
                ->where('id_user', '=', $nama_karyawan)
                ->get();

        $gapok = $users[0]->gapok;
        $tunjangan_jabatan = $users[0]->tunjangan_jabatan;
        
        $uang_makan = $kehadiran*$users[0]->uang_makan;

        $lembur = $jam_lembur*$users[0]->lembur;

        $jumlah_gaji = ($gapok + $tunjangan_jabatan + $uang_makan + $insentif + $lembur) - $pinjaman;

        $jaminan = $jumlah_gaji * (2/100);

        $total = $jumlah_gaji - $jaminan;

        // $cek = DB::table('users')
        // ->select(DB::raw('count(id) as jumlah'))
        // ->where('role_id', '=', 2)
        // ->where('id', '=', $nama_karyawan)
        // ->where('id', '=', $bulan)
        // ->get();

        // dd($cek);

        DB::table('penggajian')->insert([
            'id_users' => $nama_karyawan,
            'bulan' => $bulan,
            'gapok' => $gapok,
            'makan_transport' => $uang_makan,
            'lembur' => $lembur,
            'tunjangan' => $tunjangan_jabatan,
            'insentiv' => $insentif,
            'jamkes' => $jaminan,
            'pinjaman'=>$pinjaman,
            'total' => $total,
        ]);
        DB::table('pinjaman')
              ->where('id_users', $nama_karyawan)
              ->update(['status' => 1]);
        return redirect()->route('penggajian')
            ->with('success', 'Data berhasil disimpan.');
    }
    public function delete_penggajian($id)
    {
        DB::table('penggajian')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->route('penggajian')
            ->withSuccess('Data Penggajian berhasil dihapus');
    }
    public function detail_penggajian($id)
    {
        // $data['title'] = 'Penggajian';
        
        $penggajian = DB::select("SELECT penggajian.*, users.name, users.posisi_id, users.no_identitas FROM penggajian, users WHERE penggajian.id_users =  users.id AND penggajian.id = $id");
                
        return view('detail_penggajian', ['penggajian'=> $penggajian]);
    }
}
