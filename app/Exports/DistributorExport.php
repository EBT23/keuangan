<?php

namespace App\Exports;

use App\Models\Distributor;
use Maatwebsite\Excel\Concerns\FromCollection;

class DistributorExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Distributor::all();
    }
}
