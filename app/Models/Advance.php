<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advance extends Model
{
    use HasFactory;
    protected $table = "advances";
    protected $fillable = ['particulars', 'adv_amount', 'adv_date', 'pending_date', 'remark', 'user_status', 'status', 'added_by'];
}
