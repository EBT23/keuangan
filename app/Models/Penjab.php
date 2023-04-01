<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjab extends Model
{
    use HasFactory;
    protected $table = 'penjab'; //nama tabel pada database

    protected $fillable = [ //kolom yang diizinkan diisi secara massal
        'nama_penjab',
    ];
}
