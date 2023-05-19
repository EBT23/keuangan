<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PinjamanController extends Controller
{
    public function pinjaman()
    {
     $title['title'] = 'Kelola Pinjaman';
 
     $data = DB::table('pinjaman')
     ->join('users', 'users.id', '=', 'pinjaman.id_users')
     ->select('users.name', 'users.id AS user_id', 'pinjaman.pinjaman','pinjaman.tanggal','pinjaman.status', 'pinjaman.id')
     ->get();
     $data1 = DB::table('users')
     ->where('role_id', '=', 2)
     ->get();
 
     return view('pinjaman', ['data' => $data], ['data1' => $data1], $title);
    }
    public function tambah_pinjaman(Request $request)
    {
             // validasi input
             $request->validate([
                 'karyawan' => 'required',
                 'pinjaman' => 'required',
                 'tanggal' => 'required',
                 'status_pinjaman' => 'required',
             ]);
     
             $data = [
                 'id_users' => $request->karyawan,
                 'pinjaman' => $request->pinjaman,
                 'tanggal' => $request->tanggal,
                 'status' => $request->status_pinjaman,
 
             ];
 
             DB::table('pinjaman')->insert($data); 
             
     
             return redirect()->route('pinjaman')
                 ->with('success', 'Data berhasil disimpan.');
    }
    public function edit_pinjaman($id)
    {

     $karyawan = DB::table('users')
     ->where('role_id', '=', 2)
     ->get();
     $pinjaman = DB::table('pinjaman')
     ->where('id', '=', $id)
     ->get();

     $pinjaman = $pinjaman[0];
 
 
     return view('edit_pinjaman', ['karyawan' => $karyawan], ['pinjaman' => $pinjaman]);
    }
    public function update_pinjaman(Request $request, $id)
    {
         // Validasi request
         $request->validate([
            'karyawan' => 'required',
            'pinjaman' => 'required',
            'tanggal' => 'required',
            'status_pinjaman' => 'required',
        ]);

        $data = [
           'id_users' => $request->karyawan,
           'pinjaman' => $request->pinjaman,
           'tanggal' => $request->tanggal,
           'status' => $request->status_pinjaman, 
        ];

        DB::table('pinjaman')
              ->where('id', $id)
              ->update($data);

        
        return redirect()
            ->route('pinjaman')
            ->withSuccess('Data Pinjaman berhasil diubah');
    }
    public function delete_pinjaman($id)
    {
        DB::table('pinjaman')
        ->where('id', $id)
        ->delete();

    return redirect()
        ->route('pinjaman')
        ->withSuccess('Data Pinjaman berhasil dihapus');
    }
}
