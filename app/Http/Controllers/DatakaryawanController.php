<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatakaryawanController extends Controller
{
    public function karyawan()
     {
     $data['title'] = 'Karyawan';
     return view('datakaryawan', $data);
     }
}
