<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenggajianController extends Controller
{
    public function penggajian()
    {
        return view('penggajian');
    }
}