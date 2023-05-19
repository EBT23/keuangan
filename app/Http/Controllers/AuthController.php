<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function login_post(Request $request)
    {
        $client = new Client();

        $response = $client->request('POST', 'http://keuangan.dlhcode.com/api/login', [
            'form_params' => [
                'email' => $request->email,
                'password' => $request->password,

            ]
        ]);
        $body = $response->getbody();
        $data = json_decode($body, true);

        if (isset($data['data'])) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $session = User::where('email', $request->email)->first();
                // dd($session);
                Session::put('name', $session->name);
                $request->session()->regenerate();
            }

            session(['access_token' => $data['data']]);
            return redirect()->route('index');
        } else {
            return redirect()->back();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }








    public function register()
    {
        return view(
            'auth.register',
            ['posisi' =>  DB::table('posisi')->get()]
        );
    }


    public function register_post(Request $request)
    {

        $request->validate(
            [
                'nama' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required',
                'tgl_lahir' => 'required',
                'posisi' => 'required',
            ]
        );

        $user = [
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'total_pengeluaran' => $request->total_pengeluaran,
            'tgl' => $request->tgl,
            'created_at' => now(),
        ];

        DB::table('users')->insert($user);
        return view('auth.login');
    }
}
