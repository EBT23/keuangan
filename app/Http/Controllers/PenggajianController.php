<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenggajianController extends Controller
{
    public function penggajian()
    {
        $data['title'] = 'Penggajian';
        return view('penggajian', $data);
    }
}