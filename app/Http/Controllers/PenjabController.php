<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;

class PenjabController extends Controller
{
    public function penjab()
    {
        $data['title'] = 'Penanggung Jawab';
        $token = session('access_token');
        
        $response = Http::withToken("$token")->get('http://keuangan.dlhcode.com/api/penjab');

        $body = $response->getBody();
        $data['penjab'] = json_decode($body,true);
        $data['penjab'] = $data['penjab']['data'];
        
        return view('penjab', $data);
    }

    public function tambah_penjab(Request $request)
    {
        $token = session('access_token');

        $addPenjab = [
            'nama_penjab' => $request->nama_penjab,
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token, // token autentikasi
            'Accept' => 'application/json', // format respon
        ])->post('http://keuangan.dlhcode.com/api/tambah_penjab', $addPenjab);

        if ($response->ok()) {
            $response->json(); // data response jika request sukses
            // lakukan sesuatu dengan data response
            return redirect()
                ->route('penjab')
                ->withSuccess('Data berhasil ditambahkan');
        } else {
            $errorMessage = $response->serverError() ? 'Server error' : 'Client error'; // pesan error
            $errorMessage .= ': ' . $response->body(); // tambahkan pesan error dari body response
            // lakukan sesuatu dengan pesan error
            return redirect()->route('penjab')
                ->with('error', 'Data gagal disimpan');
        }
    }

    public function update_penjab(Request $request, $id)
    {
        $token = session('access_token');
        $client = new Client([
            'base_uri' => 'http://keuangan.dlhcode.com/api/',
            'timeout' => 50.0,
        ]);

        $response = $client->request('PUT', "update_penjab/$id", [
                'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/x-www-form-urlencoded',
            ],
            'json' => [
                'nama_penjab' => $request->nama_penjab,
                'updated_at' => now(),
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return redirect()
            ->route('penjab')
            ->withSuccess('Data Penanggung Jawab berhasil diubah');
    }

    public function edit_penjab($id)
    {
        $data['title'] = 'Edit Data Penanggung Jawab';
        $token = session('access_token');
        $client = new Client([
        'base_uri' => 'http://keuangan.dlhcode.com/api/',
        'timeout' => 2.0,
        ]);
    
        $response = $client->request('GET', "get_penjab_by_id/$id", [
        'headers' => [
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/json',
        ]
        ]);
    
        $data['penjab'] = json_decode($response->getBody(), true);
        $data['penjab'] = $data['penjab']['data'][0];
   
        return view('edit_penjab', $data);
    }

    public function delete_penjab($id)
    {
        $token = session('access_token');
        $client = new Client([
        'base_uri' => 'http://keuangan.dlhcode.com/api/',
        'timeout' => 2.0,
        ]);

        $response = $client->request('DELETE', "delete_penjab/$id", [
        'headers' => [
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/json',
        ]
        ]);

        return redirect()
            ->route('penjab')
            ->withSuccess('Data Penanggung Jawab berhasil dihapus');
    }
}