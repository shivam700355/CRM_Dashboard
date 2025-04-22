<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gst extends Model {
    use HasFactory;

     protected $fillable = [

      'name_type', 'name', 'tax_amount', 'challan_date', 'due_date', 'remark', 'status', 'added_by'
    ];
}