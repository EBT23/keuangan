<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;

    protected $table = 'pemasukan'; //nama tabel pada database

    protected $fillable = [ //kolom yang diizinkan diisi secara massal
        'jenis_pemasukan',
        'keterangan',
        'total_pemasukan',
        'tgl',
    ];
}
