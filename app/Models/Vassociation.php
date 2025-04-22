<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Vassociation extends Model
{
    use HasFactory;
    protected $fillable = [
        'p_id', 'v_id', 'remark', 'start_date', 'end_date', 'status', 'state', 'district', 'added_by'
    ];
    
}
