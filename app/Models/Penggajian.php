<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    use HasFactory;
    protected $table = 'penggajian'; //nama tabel pada database

    protected $fillable = [ //kolom yang diizinkan diisi secara massal
        'bulan',
        'hari_kerja',
        'gapok',
        'makan_transport',
        'lembur',
        'tunjangan',
        'insentiv',
        'pinjaman',
        'jamkes',
        'user_id',
        'total',
    ];
}
