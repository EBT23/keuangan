<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;
    protected $table = 'distributor'; //nama tabel pada database

    protected $fillable = [ //kolom yang diizinkan diisi secara massal
            'id',
            'nama_distributor',
            'tlp',
            'area_cover' ,
            'alamat' ,
            'penjab_id' ,
    ];

    public function pemasukan()
    {
        return $this->belongsTo('App\Models\Pemasukan');
    }
}
