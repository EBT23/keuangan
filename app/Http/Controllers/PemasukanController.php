<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;

class PemasukanController extends Controller
{
    public function pemasukan()
    {
        $data['title'] = 'Kelola Pemasukan';

        $token = session('access_token');

        $response = Http::withToken("$token")->get('http://backendkeuangan.dlhcode.com/api/pemasukan');
        $body_pemasukan = $response->getBody();
        $data['pemasukan'] = json_decode($body_pemasukan, true);
        $data['pemasukan'] = $data['pemasukan']['data'];
        return view('pemasukan', $data);
    }

    public function tambah_pemasukan(Request $request)
    {
        $token = session('access_token');

        $addPemasukan = [
            'jenis_pemasukan' => $request->jenis_pemasukan,
            'keterangan' => $request->keterangan,
            'tgl' => $request->tgl,
            'total_pemasukan' => $request->total_pemasukan,
            'updated_at' => now(),
            'created_at' => now(),
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token, // token autentikasi
            'Accept' => 'application/json', // format respon
        ])->post('http://backendkeuangan.dlhcode.com/api/tambah_pemasukan', $addPemasukan);

       

        if ($response->ok()) {
            $response->json(); // data response jika request sukses
            // lakukan sesuatu dengan data response
            return redirect()
                ->route('pemasukan')
                ->withSuccess('Pemasukan berhasil ditambahkan');
        } else {
            $errorMessage = $response->serverError() ? 'Server error' : 'Client error'; // pesan error
            $errorMessage .= ': ' . $response->body(); // tambahkan pesan error dari body response
            // lakukan sesuatu dengan pesan error
            return redirect()->route('pemasukan')
                ->with('error', 'Pemasukan gagal disimpan');
        }
    }

    public function update_pemasukan(Request $request, $id)
    {
        $token = session('access_token');
        $client = new Client([
            'base_uri' => 'http://backendkeuangan.dlhcode.com/api/',
            'timeout' => 50.0,
        ]);

        $response = $client->request('PUT', "update_pemasukan/$id", [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/x-www-form-urlencoded',
            ],
            'json' => [
                'jenis_pemasukan' => $request->jenis_pemasukan,
                'keterangan' => $request->keterangan,
                'tgl' => $request->tgl,
                'total_pemasukan' => $request->total_pemasukan,
                'updated_at' => now(),
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return redirect()
            ->route('pemasukan')
            ->withSuccess('Data Pemasukan berhasil diubah');
    }

    public function edit_pemasukan($id)
    {
        $data['title'] = 'Edit Kota';
        $token = session('access_token');
        $client = new Client([
        'base_uri' => 'http://backendkeuangan.dlhcode.com/api/',
        'timeout' => 2.0,
        ]);
    
        $response = $client->request('GET', "get_pemasukan_by_id/$id", [
        'headers' => [
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/json',
        ]
        ]);
    
    
        $data['pemasukan'] = json_decode($response->getBody(), true);
        $data['pemasukan'] = $data['pemasukan']['data'][0];
   
        return view('edit_pemasukan', $data);
    }

    public function delete_pemasukan($id)
    {
        $token = session('access_token');
        $client = new Client([
        'base_uri' => 'http://backendkeuangan.dlhcode.com/api/',
        'timeout' => 2.0,
        ]);

        $response = $client->request('DELETE', "delete_pemasukan/$id", [
        'headers' => [
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/json',
        ]
        ]);

        return redirect()
            ->route('pemasukan')
            ->withSuccess('Data Pemasukan berhasil dihapus');
    }

}