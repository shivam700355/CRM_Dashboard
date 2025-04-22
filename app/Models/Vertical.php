<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Vertical extends Model
{

    protected $table = 'verticals';

    protected $fillable = [
        'name'
    ];

    // Add validation rules for mobile and aadhaar
    public static $rules = [
        'name' => 'required',
    ];


    // You can define relationships, additional methods, etc., here
}
