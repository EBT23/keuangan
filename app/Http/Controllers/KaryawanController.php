<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    public function karyawan()
    {
        $data['title'] = 'Kelola Karyawan';

        $token = session('access_token');
        $response1 = Http::withToken("$token")->get('http://keuangan.dlhcode.com/api/posisi');
        $response = Http::withToken("$token")->get('http://keuangan.dlhcode.com/api/karyawan');
        $body = $response->getBody();
        $body1 = $response1->getBody();
        $data1['posisi'] = json_decode($body1, true);
        $data1['posisi'] = $data1['posisi']['data'];
        $data['karyawan'] = json_decode($body, true);
        $data['karyawan'] = $data['karyawan']['data'];

        // dd($data['karyawan']);

        return view('karyawan', $data, $data1);
    }

    public function tambah_karyawan(Request $request)
    {
    //    $validator = Validator::make($request->all(), [
    //         'name.required' => 'name is required',
    //         'email.required' => 'email is unique',
    //     ])->validate();

        
        $request->validate([
                'name' => 'required',
                'email' => 'required',
                'no_identitas' => 'required',
                'tempat_lahir' => 'required',
                'tgl_lahir' => 'required',
                'no_rek' => 'required',
                'posisi_id' => 'required',
                'status' => 'required',
                'domisili' => 'required',
                'no_tlp' => 'required',
        ]);

        $token = session('access_token');

        $addKaryawan = [
            'name' => $request->name,
            'email' => $request->email,
            'no_identitas' => $request->no_identitas,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'no_rek' => $request->no_rek,
            'posisi_id' => $request->posisi_id,
            'status' => $request->status,
            'domisili' => $request->domisili,
            'no_tlp' => $request->no_tlp,
            'created_at' => now(),
        ];
       
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token, // token autentikasi
            'Accept' => 'application/json', // format respon
        ])->post('http://keuangan.dlhcode.com/api/tambah_karyawan', $addKaryawan);

       

        if ($response->ok()) {
            $response->json(); // data response jika request sukses
            // lakukan sesuatu dengan data response
            return redirect()
                ->route('karyawan')
                
                ->withSuccess('Data karyawan berhasil ditambahkan');
        } else {
            $errorMessage = $response->serverError() ? 'Server error' : 'Client error'; // pesan error
            $errorMessage .= ': ' . $response->body(); // tambahkan pesan error dari body response
            // lakukan sesuatu dengan pesan error
            return redirect()->route('karyawan')
               
                ->with('error', 'Data Karyawan gagal disimpan');
        }
    }

    public function update_karyawan(Request $request, $id)
    {
        $token = session('access_token');
        $client = new Client([
            'base_uri' => 'http://keuangan.dlhcode.com/api/',
            'timeout' => 50.0,
        ]);

        $response = $client->request('PUT', "update_karyawan/$id", [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/x-www-form-urlencoded',
            ],
            'json' => [
                'name' => $request->name,
                'email' => $request->email,
                'no_identitas' => $request->no_identitas,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'no_rek' => $request->no_rek,
                'posisi_id' => $request->posisi_id,
                'status' => $request->status,
                'domisili' => $request->domisili,
                'no_tlp' => $request->no_tlp,
                'updated_at' => now(),
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return redirect()
            ->route('karyawan')
            ->withSuccess('Data Karyawan berhasil diubah');
    }

    public function edit_karyawan($id)
    {
        $data['title'] = 'Data Karyawan';
        $token = session('access_token');
        $client = new Client([
        'base_uri' => 'http://keuangan.dlhcode.com/api/',
        
        ]);
        $response1 = Http::withToken("$token")->get('http://keuangan.dlhcode.com/api/posisi');
        $response = $client->request('GET', "get_karyawan_by_id/$id", [
        'headers' => [
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/json',
        ]
        ]);
        
        $body1 = $response1->getBody();
        $data1['posisi'] = json_decode($body1, true);
        $data1['posisi'] = $data1['posisi']['data'];
    
        $data['karyawan'] = json_decode($response->getBody(), true);
        // dd($data['karyawan']);
        $data['karyawan'] = $data['karyawan']['data'][0];
   
        return view('edit_karyawan', $data, $data1);
    }

    public function delete_karyawan($id)
    {
        $token = session('access_token');
        $client = new Client([
        'base_uri' => 'http://keuangan.dlhcode.com/api/',
        'timeout' => 2.0,
        ]);

        $response = $client->request('DELETE', "delete_karyawan/$id", [
        'headers' => [
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/json',
        ]
        ]);

        return redirect()
            ->route('karyawan')
            ->withSuccess('Data Karyawan berhasil dihapus');
    }
}
