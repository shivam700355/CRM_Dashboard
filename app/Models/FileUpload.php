<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class FileUpload extends Model
{

    protected $table = 'fro_medias';

    protected $fillable = [
        'aoe_name',
        'mobile',
        'source',
        'original_name',
        'storage_name',
    ];


    // You can define relationships, additional methods, etc., here
}
