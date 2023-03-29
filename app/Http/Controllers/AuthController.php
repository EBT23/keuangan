<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    function login_post(Request $request)
    {
        $request->validate([

            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // $user = Auth::User();

            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withInput()->withErrors([
            'password' => 'Wrong username or password',
        ]);
    }
    
























    public function register()
    {
        return view('auth.register',
        ['posisi' =>  DB::table('posisi')->get()]);
    }

    public function register_post(Request $request)
    {
        $request->validate([
            'nama' =>'required',
            'posisi'=> 'required',
            'email' =>'required|unique:users,email',
            'password'=>'required'
        ]);
        dd($request);
        $user = [
            'nama' => $request->nama,
            'posisi' => $request->posisi,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 2,
            'created_at' => now(),
        ];

        DB::table('users')->insert($user);
        return route('login');

    }

}