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
        
        $response1 = Http::withToken("$token")->get('http://keuangan.dlhcode.com/api/distributor');
        $response = Http::withToken("$token")->get('http://keuangan.dlhcode.com/api/pengeluaran');
        $body_pengeluaran = $response->getBody();
        $body1 = $response1->getBody();
        $data1['distributor'] = json_decode($body1, true);
        $data1['distributor'] = $data1['distributor']['data'];
        $data['pengeluaran'] = json_decode($body_pengeluaran, true);
        $data['pengeluaran'] = $data['pengeluaran']['data'];
        return view('pengeluaran', $data, $data1);
    }

    public function tambah_pengeluaran(Request $request)
    {
        $token = session('access_token');

        $addPengeluaran = [
            'distributor_id' => $request->distributor_id,
            'keterangan' => $request->keterangan,
            'total_pengeluaran' => $request->total_pengeluaran,
            'tgl' => $request->tgl,
            'bukti_pengeluaran' => $request->bukti_pengeluaran,
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
                'distributor_id' => $request->distributor_id,
                'keterangan' => $request->keterangan,
                'total_pengeluaran' => $request->total_pengeluaran,
                'tgl' => $request->tgl,
                'bukti_pengeluaran' => $request->bukti_pengeluaran,
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
