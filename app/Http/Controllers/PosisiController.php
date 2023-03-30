<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PosisiController extends Controller
{
    public function posisi()
    {
        $data['title'] = 'Posisi';
        return view('posisi', $data);
    }
}