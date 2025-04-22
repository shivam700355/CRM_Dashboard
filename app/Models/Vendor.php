<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'mobile', 'email', 'address', 'state', 'district', 'remark','added_by'
    ];

    // Add any additional relationships or methods if needed
}
