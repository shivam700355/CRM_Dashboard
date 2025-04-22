<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Passociation extends Model
{
    use HasFactory;

    protected $table = 'passociations';
    
    protected $fillable = [
        'p_id', 'u_id', 'status', 'role', 'added_by'
    ];
    
}
