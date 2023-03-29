<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    public function pemasukan()
    {
        return view('pemasukan');
    }
}