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
        $bulan = $request->bulan;
        $nama_karyawan = $request->nama_karyawan;
        $jam_lembur = $request->lembur;
        $insentif = $request->insentiv;
        $kehadiran = $request->kehadiran;
        $pinjaman= $request->pinjaman;

        $users = DB::table('users')
                ->where('role_id', '=', 2)
                ->where('id', '=', $nama_karyawan)
                ->get();
       
        if ($users[0]->posisi_id == '1') {
            $gapok = 1400000;
            $tunjangan_jabatan = 200000;
        }elseif($users[0]->posisi_id == '2' || $users[0]->posisi_id == '3' || $users[0]->posisi_id == '4' ){
            $gapok = 1600000;
            $tunjangan_jabatan = 300000;
        }elseif ($users[0]->posisi_id == '5' || $users[0]->posisi_id == '6' || $users[0]->posisi_id == '7') {
            $gapok = 1800000;
            $tunjangan_jabatan = 400000;
        }elseif ($users[0]->posisi_id == '8') {
            $gapok = 2000000;
            $tunjangan_jabatan = 500000;
        }else{
            $gapok = 0;
            $tunjangan_jabatan = 0;
        }
        
        $uang_makan = $kehadiran*15000;

        $lembur = $jam_lembur*60000;

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