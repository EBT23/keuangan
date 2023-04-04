<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
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

    public function update_posisi(Request $request, $id)
    {
        $token = session('access_token');
        $client = new Client([
            'base_uri' => 'http://keuangan.dlhcode.com/api/',
            'timeout' => 50.0,
        ]);

        $response = $client->request('PUT', "update_posisi/$id", [
                'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/x-www-form-urlencoded',
            ],
            'json' => [
                'nama_posisi' => $request->nama_posisi,
                'updated_at' => now(),
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return redirect()
            ->route('posisi')
            ->withSuccess('Data Posisi berhasil diubah');
    }

    public function edit_posisi($id)
    {
        $data['title'] = 'Edit Data Posisi';
        $token = session('access_token');
        $client = new Client([
        'base_uri' => 'http://keuangan.dlhcode.com/api/',
        'timeout' => 2.0,
        ]);
    
        $response = $client->request('GET', "get_posisi_by_id/$id", [
        'headers' => [
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/json',
        ]
        ]);
    
    
        $data['posisi'] = json_decode($response->getBody(), true);
        $data['posisi'] = $data['posisi']['data'][0];
   
        return view('edit_posisi', $data);
    }

    public function delete_posisi($id)
    {
        $token = session('access_token');
        $client = new Client([
        'base_uri' => 'http://keuangan.dlhcode.com/api/',
        'timeout' => 2.0,
        ]);

        $response = $client->request('DELETE', "delete_posisi/$id", [
        'headers' => [
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/json',
        ]
        ]);

        return redirect()
            ->route('posisi')
            ->withSuccess('Data Posisi berhasil dihapus');
    }
}