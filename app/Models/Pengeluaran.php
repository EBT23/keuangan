<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;
    protected $table = 'pengeluaran'; //nama tabel pada database

    protected $fillable = [ //kolom yang diizinkan diisi secara massal
        'jenis_pengeluaran',
        'keterangan',
        'total_pengeluaran',
        'tgl',
    ];
}
