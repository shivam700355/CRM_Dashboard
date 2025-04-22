<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model {
    use HasFactory;

     protected $fillable = [

      'name', 'pro_id', 'description', 'added_by', 'status'
    ];
}