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

        $response = Http::withToken("$token")->get('http://keuangan.dlhcode.com/api/karyawan');
        $body = $response->getBody();
        $data['karyawan'] = json_decode($body, true);
        $data['karyawan'] = $data['karyawan']['data'];
        return view('karyawan', $data);
    }
}
