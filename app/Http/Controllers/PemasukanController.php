<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use App\Models\Pemasukan;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PemasukanController extends Controller
{
    public function pemasukan()
    {
        $title['title'] = 'Kelola Pemasukan';
       
       $data = DB::table('pemasukan')
       ->join('distributor', 'distributor.id', '=', 'pemasukan.distributor_id')
       ->select('pemasukan.*', 'distributor.nama_distributor')
       ->get();
       $data1 = Distributor::all();

        return view('pemasukan', ['data' => $data],['data1' => $data1 ], $title);
    }

    public function tambah_pemasukan(Request $request)
    {
        
            // validasi input
        $request->validate([
            'distributor_id' => 'required',
            'keterangan' => 'required',
            'tgl' => 'required',
            'total_pemasukan' => 'required',
            'bukti_pemasukan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // menyimpan data
        $data = new Pemasukan();
        $data->distributor_id = $request->distributor_id;
        $data->keterangan = $request->keterangan;
        $data->tgl = $request->tgl;
        $data->total_pemasukan = $request->total_pemasukan;
        $data->bukti_pemasukan = $request->bukti_pemasukan;

        // simpan file
        if ($request->hasFile('bukti_pemasukan')) {
            $file = $request->file('bukti_pemasukan');
            $filename = time() . '-' . $file->getClientOriginalName();
            $path = $file->move(public_path('upload/pemasukan'), $filename);
            $data->bukti_pemasukan = $filename;
        }
        $data->save();

        return redirect()->route('pemasukan')
            ->with('success', 'Data berhasil disimpan.');
    }

    public function update_pemasukan(Request $request, $id)
    {   
        // Validasi request
        $request->validate([
            'distributor_id' => 'required',
            'keterangan' => 'required|string',
            'tgl' => 'required',
            'total_pemasukan' => 'required|numeric|min:0',
            'bukti_pemasukan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

         // Cari item berdasarkan id
        $pemasukan = Pemasukan::find($id);

        // Jika item tidak ditemukan, kembalikan response error 404
        if (!$pemasukan) {
            return response()->json([
                'message' => 'Data not found'
            ], 404);
        }

        // Update data pemasukan
            $pemasukan->distributor_id = $request->distributor_id;
            $pemasukan->keterangan = $request->keterangan;
            $pemasukan->tgl = $request->tgl;
            $pemasukan->total_pemasukan = $request->total_pemasukan;
            $pemasukan->updated_at = now();

         // simpan file
        if ($request->hasFile('bukti_pemasukan')) {
            $file = $request->file('bukti_pemasukan');
            $filename = time() . '-' . $file->getClientOriginalName();
            $path = $file->move(public_path('upload/pemasukan'), $filename);
            $pemasukan->bukti_pemasukan = $filename;
        }

        $pemasukan->save();

        
        return redirect()
            ->route('pemasukan')
            ->withSuccess('Data Pemasukan berhasil diubah');
    }

    public function edit_pemasukan($id)
    {
        // $data['title'] = 'Edit Data Pemasukan';

        $distributor = Distributor::all();
        $pemasukan = Pemasukan::find($id); // Ambil data pemasukan berdasarkan ID

   
        return view('edit_pemasukan', ['pemasukan' => $pemasukan], ['distributor' => $distributor]);
    }

    public function delete_pemasukan($id)
    {
        DB::table('pemasukan')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->route('pemasukan')
            ->withSuccess('Data Pemasukan berhasil dihapus');
    }

}