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
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $session = User::where('email', $request->email)->first();
            // dd($session);
            Session::put('name', $session->name);

            $request->session()->regenerate();
            return redirect()->route('index');
        }

        return back()->withInput()->withErrors([
            'password' => 'Wrong username or password',
        ]);
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
        return view('auth.register',
        ['posisi' =>  DB::table('posisi')->get()]);
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
            ]);

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