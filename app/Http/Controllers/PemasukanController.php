<?php

namespace App\Http\Controllers;

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
        $data['title'] = 'Kelola Pemasukan';
       
        $token = session('access_token');

        $response1 = Http::withToken("$token")->get('http://keuangan.dlhcode.com/api/distributor');
        $response = Http::withToken("$token")->get('http://keuangan.dlhcode.com/api/pemasukan');
        $body_pemasukan = $response->getBody();
        $body1 = $response1->getBody();
        $data1['distributor'] = json_decode($body1, true);
        $data1['distributor'] = $data1['distributor']['data'];
        $data['pemasukan'] = json_decode($body_pemasukan, true);
        $data['pemasukan'] = $data['pemasukan']['data'];
        // dd($data['pemasukan']);
        return view('pemasukan', $data, $data1);
    }

    public function tambah_pemasukan(Request $request)
    {
        
            // validasi input
        $request->validate([
            'distributor_id' => 'required',
            'keterangan' => 'required',
            'tgl' => 'required',
            'total_pemasukan' => 'required',
            'bukti_pemasukan' => 'required|file|max:2048',
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
        $token = session('access_token');
        $client = new Client([
            'base_uri' => 'http://keuangan.dlhcode.com/api/',
            'timeout' => 50.0,
        ]);

        $response = $client->request('PUT', "update_pemasukan/$id", [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/x-www-form-urlencoded',
            ],
            'json' => [
                'distributor_id' => $request->distributor_id,
                'keterangan' => $request->keterangan,
                'tgl' => $request->tgl,
                'total_pemasukan' => $request->total_pemasukan,
                'bukti_pemasukan' => $request->bukti_pemasukan,
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

        $data['title'] = 'Edit Data Pemasukan';
        $token = session('access_token');
        $client = new Client([
        'base_uri' => 'http://keuangan.dlhcode.com/api/',
        'timeout' => 2.0,
        ]);
      
        $response1 = Http::withToken("$token")->get('http://keuangan.dlhcode.com/api/distributor');
        $response = $client->request('GET', "get_pemasukan_by_id/$id", [
        'headers' => [
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/json',
        ]
        ]);
    
        $body1 = $response1->getBody();
        $data1['distributor'] = json_decode($body1, true);
        $data1['distributor'] = $data1['distributor']['data'];
        $data['pemasukan'] = json_decode($response->getBody(), true);
        $data['pemasukan'] = $data['pemasukan']['data'][0];
   
        return view('edit_pemasukan', $data, $data1);
    }

    public function delete_pemasukan($id)
    {
        $token = session('access_token');
        $client = new Client([
        'base_uri' => 'http://keuangan.dlhcode.com/api/',
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