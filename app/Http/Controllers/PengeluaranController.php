<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PengeluaranController extends Controller
{
    public function pengeluaran()
    {
        $data['title'] = 'Pengeluaran';
        $token = session('access_token');
        
        $response = Http::withToken("$token")->get('https://backendkeuangan.dlhcode.com/api/pengeluaran');

        $body = $response->getBody();
        $data['pengeluaran'] = json_decode($body,true);
        $data['pengeluaran'] = $data['pengeluaran']['data'];
        
        return view('pengeluaran', $data);
    }

    public function tambah_pengeluaran(Request $request)
    {
        $token = session('access_token');
        $data = [
            'jenis_pengeluaran' => $request->jenis_pengeluaran,
            'email' => $request->email,
            'tgl_lahir' => $request->tgl_lahir,
            'password' => bcrypt($request->password),
            'role_id' => 2,
            'posisi_id' => $request->posisi,
        ];
    }
   
}