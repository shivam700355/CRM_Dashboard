<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  use HasFactory;

  protected $fillable = [

    'pay_date',
    'vendor_name',
    'voucher_no',
    'pay_amount',
    'initiated_by',
    'checked_by',
    'approved_by',
    'remark',
    'status',
    'added_by'
  ];
}