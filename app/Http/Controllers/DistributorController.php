<?php

namespace App\Http\Controllers;

use App\Exports\DistributorExport;
use App\Models\Distributor;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class DistributorController extends Controller
{
     public function distributor()
    {
        $data['title'] = 'Kelola Distributor';

        $token = session('access_token');

        $response1 = Http::withToken("$token")->get('http://keuangan.dlhcode.com/api/penjab');
        $response = Http::withToken("$token")->get('http://keuangan.dlhcode.com/api/distributor');
        $body_distributor = $response->getBody();
        $body1 = $response1->getBody();
        $data1['penjab'] = json_decode($body1, true);
        $data1['penjab'] = $data1['penjab']['data'];
        $data['distributor'] = json_decode($body_distributor, true);
        $data['distributor'] = $data['distributor']['data'];
        return view('distributor', $data, $data1);
    }

    public function tambah_distributor(Request $request)
    {
        // dd($request);
        $token = session('access_token');

        $addDistributor = [
            'nama_distributor' => $request->nama_distributor,
            'tlp' => $request->tlp,
            'area_cover' => $request->area_cover,
            'alamat' => $request->alamat,
            'penjab' => $request->penjab,
            'updated_at' => now(),
            'created_at' => now(),
        ];

        // dd($addDistributor);
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token, // token autentikasi
            'Accept' => 'application/json', // format respon
        ])->post('http://keuangan.dlhcode.com/api/tambah_distributor', $addDistributor);


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

    public function update_distributor(Request $request, $id)
    {
        $token = session('access_token');
        $client = new Client([
            'base_uri' => 'http://keuangan.dlhcode.com/api/',
            'timeout' => 50.0,
        ]);

        $response = $client->request('PUT', "update_distributor/$id", [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/x-www-form-urlencoded',
            ],
            'json' => [
                'nama_distributor' => $request->nama_distributor,
                'tlp' => $request->tlp,
                'area_cover' => $request->area_cover,
                'alamat' => $request->alamat,
                'penjab' => $request->penjab,
                'updated_at' => now(),
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return redirect()
            ->route('distributor')
            ->withSuccess('Data Distributor berhasil diubah');
    }

    public function edit_distributor($id)
    {
        $data['title'] = 'Edit Data Distributor';
        $token = session('access_token');
        $client = new Client([
        'base_uri' => 'http://keuangan.dlhcode.com/api/',
        'timeout' => 2.0,
        ]);
    
        $response = $client->request('GET', "get_distributor_by_id/$id", [
        'headers' => [
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/json',
        ]
        ]);
    
    
        $data['distributor'] = json_decode($response->getBody(), true);
        $data['distributor'] = $data['distributor']['data'][0];
   
        return view('edit_distributor', $data);
    }

    public function delete_distributor($id)
    {
        $token = session('access_token');
        $client = new Client([
        'base_uri' => 'http://keuangan.dlhcode.com/api/',
        'timeout' => 2.0,
        ]);

        $response = $client->request('DELETE', "delete_distributor/$id", [
            'headers' => [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
            ]
        ]);

        return redirect()
            ->route('distributor')
            ->withSuccess('Data distributor berhasil dihapus');
    }

    public function export_excel()
    {
        return Excel::download(new DistributorExport,'dsitributor.xlsx');
    }
}