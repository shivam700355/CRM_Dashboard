<?php

namespace App\Imports;

use App\Models\Bcuser;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportBcusers implements ToModel {
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row) {

         //print_r($row);
         //die();

        return new Bcuser([ 
            'user_id' => @$row[0],  
            'fe_name'  => @$row[1],
            'bc_name'  => @$row[2],
            'phone'  => @$row[3], 
            'district'  => @$row[4],
            'state'  => @$row[5],
            'bank_name'  => @$row[6],
            'ko_code'  => @$row[7],
            'region'  => @$row[8],
            'pan'  => @$row[9], 
        ]);
    }
}
