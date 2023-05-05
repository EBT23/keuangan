<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengaturanGajiController extends Controller
{
   public function pengaturan_gaji()
   {
        $users = DB::table('users')
        ->where('role_id', '=', 2)
        ->get();
        
        $pengaturan_gaji = DB::table('pengaturan_gaji')
            ->join('users', 'users.id', '=', 'pengaturan_gaji.id_user')
            ->join('posisi', 'posisi.id', '=', 'users.posisi_id')
            ->select('pengaturan_gaji.*', 'users.name', 'posisi.nama_posisi', 'users.no_identitas')
            ->get();

            return view('pengaturan_gaji', ['users'=> $users], ['pengaturan_gaji'=> $pengaturan_gaji]);
    
   }
   public function tambah_pengaturan_gaji(Request $request)
   {
        $karyawan = $request->nama_karyawan;
        $gaji_pokok = $request->gapok;
        $tunjangan_jabatan = $request->tunjangan_jabatan;
        $uang_makan = $request->uang_makan;
        $lembur = $request->lembur;

        $pengaturan_gaji = DB::table('pengaturan_gaji')
        ->select(DB::raw('count(pengaturan_gaji.id_user) as jumlah'))
        ->where('id_user', '=', $karyawan)
        ->get();

        
        $cek_karyawan = $pengaturan_gaji[0]->jumlah;

        if ($cek_karyawan < 1) {
                DB::table('pengaturan_gaji')->insert([
                        'id_user' => $karyawan,
                        'gapok' => $gaji_pokok,
                        'tunjangan_jabatan' => $tunjangan_jabatan,
                        'uang_makan' => $uang_makan,
                        'lembur' => $lembur,
                    ]);
            
                    return redirect()->route('pengaturan_gaji')
                        ->with('success', 'Data berhasil disimpan.');
        }else {
                return redirect()->route('pengaturan_gaji')
                        ->with('errors', 'Data users sudah ada !!.');
        }        
   }
   public function delete_pengaturan_gaji($id)
   {
        DB::table('pengaturan_gaji')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->route('pengaturan_gaji')
            ->withSuccess('Data Penggajian berhasil dihapus');
   }
   public function edit_pengaturan_gaji(Request $request)
   {
        $id = $request->id;
        $id_user = $request->id_user;
        $gapok = $request->gapok;
        $tunjangan_jabatan = $request->tunjangan_jabatan;
        $uang_makan = $request->uang_makan;
        $lembur = $request->lembur;

         DB::table('pengaturan_gaji')
              ->where('id', $id)
              ->update(['id_user' => $id_user],['gapok' => $gapok],['tunjangan_jabatan' => $tunjangan_jabatan],['uang_makan' => $uang_makan],['lembur' => $lembur]);

              return redirect()->route('pengaturan_gaji')
                        ->with('success', 'Data berhasil edit');
   }
}
