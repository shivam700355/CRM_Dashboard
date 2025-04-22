<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Epf extends Model
{
  use HasFactory;

  protected $fillable = [

    'name_type',
    'name',
    'amount',
    'challan_period',
    'challan_date',
    'due_date',
    'remark',
    'status',
    'added_by'
  ];
}