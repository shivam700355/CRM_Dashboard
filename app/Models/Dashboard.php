<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;
    protected $table = "dashboard";
    protected $fillable = [

        'district',
        'ms_b_trained',
        'ms_s_letter',
        'geo_re',
        'odop_cert',
        'odop_sls',
        'odop_bs',
        'gky_p_t',
        'gky_p',
        'stt_t',
        'stt_a_d',
        'svg',

    ];
}
