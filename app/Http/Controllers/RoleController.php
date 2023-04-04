<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class RoleController extends Controller
{
    public function role()
    {
        $data['title'] = 'Role Management';
        $token = session('access_token');
        
        $response = Http::withToken("$token")->get('http://keuangan.dlhcode.com/api/role');

        $body = $response->getBody();
        $data['role'] = json_decode($body,true);
        $data['role'] = $data['role']['data'];
        
        return view('role', $data);
    }

    public function tambah_role(Request $request)
    {
        $token = session('access_token');

        $addRole = [
            'role' => $request->role,
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token, // token autentikasi
            'Accept' => 'application/json', // format respon
        ])->post('http://keuangan.dlhcode.com/api/tambah_role', $addRole);

        if ($response->ok()) {
            $response->json(); // data response jika request sukses
            // lakukan sesuatu dengan data response
            return redirect()
                ->route('role')
                ->withSuccess('Role berhasil ditambahkan');
        } else {
            $errorMessage = $response->serverError() ? 'Server error' : 'Client error'; // pesan error
            $errorMessage .= ': ' . $response->body(); // tambahkan pesan error dari body response
            // lakukan sesuatu dengan pesan error
            return redirect()->route('role')
                ->with('error', 'Role gagal disimpan');
        }
    }

    public function update_role(Request $request, $id)
    {
        $token = session('access_token');
        $client = new Client([
            'base_uri' => 'http://keuangan.dlhcode.com/api/',
            'timeout' => 50.0,
        ]);

        $response = $client->request('PUT', "update_role/$id", [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/x-www-form-urlencoded',
            ],
            'json' => [
                'role' => $request->role,
                'updated_at' => now(),
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return redirect()
            ->route('role')
            ->withSuccess('Data Role berhasil diubah');
    }

    public function edit_role($id)
    {
        $data['title'] = 'Edit Data Role';
        $token = session('access_token');
        $client = new Client([
        'base_uri' => 'http://keuangan.dlhcode.com/api/',
        'timeout' => 2.0,
        ]);
    
        $response = $client->request('GET', "get_role_by_id/$id", [
        'headers' => [
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/json',
        ]
        ]);
    
    
        $data['role'] = json_decode($response->getBody(), true);
        $data['role'] = $data['role']['data'][0];
   
        return view('edit_role', $data);
    }

    public function delete_role($id)
    {
        $token = session('access_token');
        $client = new Client([
        'base_uri' => 'http://keuangan.dlhcode.com/api/',
        'timeout' => 2.0,
        ]);

        $response = $client->request('DELETE', "delete_role/$id", [
        'headers' => [
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/json',
        ]
        ]);

        return redirect()
            ->route('role')
            ->withSuccess('Data Role berhasil dihapus');
    }
}