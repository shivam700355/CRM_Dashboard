<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Application extends Model {
    protected $fillable = [
        'name', 'mobile', 'email', 'state', 'district', 'address', 'added_by', 'status', 'remark',
    ];
    // Add validation rules for mobile and aadhaar
    public static $rules = [
        'name' => 'required|string|max:255',
        'mobile' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'district' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'added_by' => 'required|string|max:255',
        'status' => 'required|string|max:255',
        'remark' => 'required|string|max:255',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    // You can define relationships, additional methods, etc., here
}
