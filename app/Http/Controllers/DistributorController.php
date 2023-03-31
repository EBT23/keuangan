<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DistributorController extends Controller
{
     public function distributor()
    {
        $data['title'] = 'Kelola Distributor';

        $token = session('access_token');

        $response = Http::withToken("$token")->get('http://backendkeuangan.dlhcode.com/api/distributor');
        $body_distributor = $response->getBody();
        $data['distributor'] = json_decode($body_distributor, true);
        $data['distributor'] = $data['distributor']['data'];
        return view('distributor', $data);
    }

    public function tambah_distributor(Request $request)
    {
        $token = session('access_token');

        $addDistributor = [
            'nama_distributor' => $request->nama_distributor,
            'tlp' => $request->tlp,
            'area_cover' => $request->area_cover,
            'alamat' => $request->alamat,
            'penjab_id' => $request->penjab_id,
            'updated_at' => now(),
            'created_at' => now(),
        ];

        // dd($addDistributor);
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token, // token autentikasi
            'Accept' => 'application/json', // format respon
        ])->post('https://backendkeuangan.dlhcode.com/api/tambah_distributor', $addDistributor);


        if ($response->ok()) {
            $response->json(); // data response jika request sukses
            // lakukan sesuatu dengan data response
            return redirect()
                ->route('distributor')
                ->withSuccess('Distributor berhasil ditambahkan');
        } else {
            $errorMessage = $response->serverError() ? 'Server error' : 'Client error'; // pesan error
            $errorMessage .= ': ' . $response->body(); // tambahkan pesan error dari body response
            // lakukan sesuatu dengan pesan error
            return redirect()->route('distributor')
                ->with('error', 'Distributor gagal disimpan');
        }
    }
}