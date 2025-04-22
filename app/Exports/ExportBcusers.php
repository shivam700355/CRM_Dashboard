<?php

namespace App\Exports;

use App\Models\Bcuser;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportBcusers implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Bcuser::all();
    }
}
