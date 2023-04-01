<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PengeluaranController extends Controller
{
    public function pengeluaran()
    {
        $data['title'] = 'Pengeluaran';
        $token = session('access_token');
        
        $response = Http::withToken("$token")->get('http://keuangan.dlhcode.com/api/pengeluaran');

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
        ])->post('http://keuangan.dlhcode.com/api/tambah_pengeluaran', $addPengeluaran);

       

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

    public function edit_pengeluaran($id)
    {
        $data['title'] = 'Edit Pengeluaran';
        $token = session('access_token');
        $client = new Client([
        'base_uri' => 'http://keuangan.dlhcode.com/api/',
        'timeout' => 2.0,
        ]);
    
        $response = $client->request('GET', "get_pengeluaran_by_id/$id", [
        'headers' => [
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/json',
        ]
        ]);
    
    
        $data['pengeluaran'] = json_decode($response->getBody(), true);
        $data['pengeluaran'] = $data['pengeluaran']['data'][0];
   
        return view('edit_pengeluaran', $data);
    }

    public function update_pengeluaran(Request $request, $id)
    {
        $token = session('access_token');
        $client = new Client([
            'base_uri' => 'http://keuangan.dlhcode.com/api/',
            'timeout' => 50.0,
        ]);

        $response = $client->request('PUT', "update_pengeluaran/$id", [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/x-www-form-urlencoded',
            ],
            'json' => [
                'jenis_pengeluaran' => $request->jenis_pengeluaran,
                'keterangan' => $request->keterangan,
                'tgl' => $request->tgl,
                'total_pengeluaran' => $request->total_pengeluaran,
                'updated_at' => now(),
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return redirect()
            ->route('pengeluaran')
            ->withSuccess('Data pengeluaran berhasil diubah');
    }



    public function delete_pengeluaran($id)
    {
        $token = session('access_token');
        $client = new Client([
        'base_uri' => 'http://keuangan.dlhcode.com/api/',
        'timeout' => 2.0,
        ]);

        $response = $client->request('DELETE', "delete_pengeluaran/$id", [
        'headers' => [
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/json',
        ]
        ]);

        return redirect()
            ->route('pengeluaran')
            ->withSuccess('Data pengeluaran berhasil dihapus');
    }
}
