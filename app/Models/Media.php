<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model {
    use HasFactory;
    protected $table = 'medias';
    protected $fillable = ['original_name','name', 'type', 'vass_id', 'remark', 'added_by', 'project_id'];

}
