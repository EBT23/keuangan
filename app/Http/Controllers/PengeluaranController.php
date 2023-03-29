<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function pengeluaran()
    {
        return view('pengeluaran');
    }
}