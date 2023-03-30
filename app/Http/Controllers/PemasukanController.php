<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    public function pemasukan()
    {
        $data['title'] = 'Pemasukan';
        return view('pemasukan', $data);
    }
}