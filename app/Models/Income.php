<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    protected $table = "incomes";
    protected $fillable = ['name_type', 'tds_amount', 'challan_no', 'challan_date', 'due_date', 'remark', 'status', 'added_by'];
}
