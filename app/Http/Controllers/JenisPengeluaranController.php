<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisPengeluaranController extends Controller
{
    public function jenis_pengeluaran()
    {
        $data['title'] = 'Jenis Pengeluaran';

        $jp = DB::table('jenis_pengeluaran')->get();

        return view('jenis_pengeluaran', ['jenis_pengeluaran' => $jp], $data );
    }

    public function addJenis_pengeluaran(Request $request)
    {
        // validasi input
        $request->validate([
            'jenis_pengeluaran' => 'required',
            
        ]);

        // menyimpan data
        DB::table('jenis_pengeluaran')->insert([
            'jenis_pengeluaran' => $request->jenis_pengeluaran,
        ]);
       

        return redirect()->route('jenis.pengeluaran')
        ->with('success', 'Data berhasil disimpan.');
    }

    public function delete_jp($id)
    {
        DB::table('jenis_pengeluaran')
            ->where('id', $id)
            ->delete();
 
        return redirect() 
            ->route('jenis.pengeluaran')
            ->withSuccess('Data Jenis Pengeluaran berhasil dihapus');
    }
}