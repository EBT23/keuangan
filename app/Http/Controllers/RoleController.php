<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function role()
    {
    return view('role', 
    ['role' =>  DB::table('role')->get()]);
    }
}