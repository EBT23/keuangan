<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PosisiController extends Controller
{
    public function posisi()
    {
        $data['title'] = 'Posisi';
        $token = session('access_token');
        
        $response = Http::withToken("$token")->get('http://keuangan.dlhcode.com/api/posisi');

        $body = $response->getBody();
        $data['posisi'] = json_decode($body,true);
        $data['posisi'] = $data['posisi']['data'];
        
        return view('posisi', $data);
    }

    public function tambah_posisi(Request $request)
    {
        $token = session('access_token');

        $addPosisi = [
            'nama_posisi' => $request->nama_posisi,
            'updated_at' => now(),
            'created_at' => now(),
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token, // token autentikasi
            'Accept' => 'application/json', // format respon
        ])->post('http://keuangan.dlhcode.com/api/tambah_posisi', $addPosisi);


        if ($response->ok()) {
            $response->json(); // data response jika request sukses
            // lakukan sesuatu dengan data response
            return redirect()
                ->route('posisi')
                ->withSuccess('Posisi berhasil ditambahkan');
        } else {
            $errorMessage = $response->serverError() ? 'Server error' : 'Client error'; // pesan error
            $errorMessage .= ': ' . $response->body(); // tambahkan pesan error dari body response
            // lakukan sesuatu dengan pesan error
            return redirect()->route('posisi')
                ->with('error', 'Posisi gagal disimpan');
        }
    }
}