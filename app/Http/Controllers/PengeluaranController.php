<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function pengeluaran()
    {
        $data['title'] = 'Pengeluaran';
        return view('pengeluaran', $data);
    }
}