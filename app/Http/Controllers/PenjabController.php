<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenjabController extends Controller
{
    public function penjab()
    {
    $data['title'] = 'Penanggung Jawab';
    return view('penjab', $data);
    }
}