<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function login_post(Request $request)
    {
        $client = new Client();
        $response = $client->request('POST','https://backendkeuangan.dlhcode.com/api/login',[
            'form_params' =>[
                'email' => $request->email,
                'password' => $request->password,

            ]
            ]);
            $body = $response->getbody();
            $data = json_decode($body, true);

            if(isset($data['data'])){
                session(['access_token' => $data['data']]);
                return redirect()->route('index');
            }else{
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
            'email' => $request->email,
            'tgl_lahir' => $request->tgl_lahir,
            'password' => bcrypt($request->password),
            'role_id' => 2,
            'posisi_id' => $request->posisi,
            'created_at' => now(),
        ];

        DB::table('users')->insert($user);
        return view('auth.login');


    }
}