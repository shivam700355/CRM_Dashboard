<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  use HasFactory;

  protected $fillable = [

    'p_name',
    'p_target',
    'p_status',
    'f_year',
    'p_details',
    'n_spoc',
    'added_by',
    'status',
    'vertical_id',
    'report'
  ];
}