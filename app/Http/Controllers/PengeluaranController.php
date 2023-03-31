<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PengeluaranController extends Controller
{
    public function pengeluaran()
    {
        $data['title'] = 'Pengeluaran';
        $token = session('access_token');
        
        $response = Http::withToken("$token")->get('http://backendkeuangan.dlhcode.com/api/pengeluaran');

        $body = $response->getBody();
        $data['pengeluaran'] = json_decode($body,true);
        $data['pengeluaran'] = $data['pengeluaran']['data'];
        
        return view('pengeluaran', $data);
    }

    public function tambah_pengeluaran(Request $request)
    {
        $token = session('access_token');

        $addPengeluaran = [
            'jenis_pengeluaran' => $request->jenis_pengeluaran,
            'keterangan' => $request->keterangan,
            'total_pengeluaran' => $request->total_pengeluaran,
            'tgl' => $request->tgl,
            'updated_at' => now(),
            'created_at' => now(),
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token, // token autentikasi
            'Accept' => 'application/json', // format respon
        ])->post('http://backendkeuangan.dlhcode.com/api/tambah_pengeluaran', $addPengeluaran);

       

        if ($response->ok()) {
            $response->json(); // data response jika request sukses
            // lakukan sesuatu dengan data response
            return redirect()
                ->route('pengeluaran')
                ->withSuccess('Pengeluaran berhasil ditambahkan');
        } else {
            $errorMessage = $response->serverError() ? 'Server error' : 'Client error'; // pesan error
            $errorMessage .= ': ' . $response->body(); // tambahkan pesan error dari body response
            // lakukan sesuatu dengan pesan error
            return redirect()->route('pengeluaran')
                ->with('error', 'Pengeluaran gagal disimpan');
        }
    }
   
}