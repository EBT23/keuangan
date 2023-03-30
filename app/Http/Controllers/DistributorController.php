<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DistributorController extends Controller
{
     public function distributor()
     {
     $data['title'] = 'Distributor';
     return view('distributor', $data);
     }
}