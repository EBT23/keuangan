<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use App\Models\Pengeluaran;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PengeluaranController extends Controller
{
    public function pengeluaran()
    {
        $data['title'] = 'Kelola Pengeluaran';
       
       $pengeluaran = DB::table('pengeluaran')
       ->join('distributor', 'distributor.id', '=', 'pengeluaran.distributor_id')
       ->select('pengeluaran.*', 'distributor.nama_distributor')
       ->get();
       $distributor = Distributor::all();

        return view('pengeluaran', ['pengeluaran' => $pengeluaran],['distributor' => $distributor ], $data);
    }

    public function tambah_pengeluaran(Request $request)
    {
         // validasi input
         $request->validate([
            'distributor_id' => 'required',
            'keterangan' => 'required',
            'tgl' => 'required',
            'total_pengeluaran' => 'required',
            'bukti_pengeluaran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // menyimpan data
        $data = new Pengeluaran();
        $data->distributor_id = $request->distributor_id;
        $data->keterangan = $request->keterangan;
        $data->tgl = $request->tgl;
        $data->total_pengeluaran = $request->total_pengeluaran;
        $data->bukti_pengeluaran = $request->bukti_pengeluaran;

        // simpan file
        if ($request->hasFile('bukti_pengeluaran')) {
            $file = $request->file('bukti_pengeluaran');
            $filename = time() . '-' . $file->getClientOriginalName();
            $path = $file->move(public_path('upload/pengeluaran'), $filename);
            $data->bukti_pengeluaran = $filename;
        }
        $data->save();

        return redirect()->route('pengeluaran')
            ->with('success', 'Data berhasil disimpan.');
    }

    public function edit_pengeluaran($id) 
    {
       
        $distributor = Distributor::all();
        $pengeluaran = Pengeluaran::find($id); // Ambil data pengeluaran berdasarkan ID

   
        return view('edit_pengeluaran', ['pengeluaran' => $pengeluaran], ['distributor' => $distributor]);
    }

    public function update_pengeluaran(Request $request, $id)
    {
       // Validasi request
       $request->validate([
        'distributor_id' => 'required',
        'keterangan' => 'required|string',
        'tgl' => 'required',
        'total_pengeluaran' => 'required|numeric|min:0',
        'bukti_pengeluaran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

     // Cari item berdasarkan id
    $pengeluaran = Pengeluaran::find($id);

    // Jika item tidak ditemukan, kembalikan response error 404
    if (!$pengeluaran) {
        return response()->json([
            'message' => 'Data not found'
        ], 404);
    }

    // Update data pengeluaran
        $pengeluaran->distributor_id = $request->distributor_id;
        $pengeluaran->keterangan = $request->keterangan;
        $pengeluaran->tgl = $request->tgl;
        $pengeluaran->total_pengeluaran = $request->total_pengeluaran;
        $pengeluaran->updated_at = now();

     // simpan file
    if ($request->hasFile('bukti_pengeluaran')) {
        $file = $request->file('bukti_pengeluaran');
        $filename = time() . '-' . $file->getClientOriginalName();
        $path = $file->move(public_path('upload/pengeluaran'), $filename);
        $pengeluaran->bukti_pengeluaran = $filename;
    }

    $pengeluaran->save();

    
    return redirect()
        ->route('pengeluaran')
        ->withSuccess('Data Pengeluaran berhasil diubah');
    }



    public function delete_pengeluaran($id) 
    { 
        DB::table('pengeluaran')
            ->where('id', $id)
            ->delete();
 
        return redirect() 
            ->route('pemasukan')
            ->withSuccess('Data Pengeluaran berhasil dihapus');
    } 
} 
