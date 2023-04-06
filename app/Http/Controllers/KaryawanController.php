<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

        return view('karyawan', $data, $data1);
    }

    public function tambah_karyawan(Request $request)
    {
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
}
