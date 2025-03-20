<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    
    protected $table = 'lecturer';
    
    protected $fillable = [
        'id',
        'user_id',
        'full_name',
        'nic',
        'dob',
        'address',
        'phone_number',
        'department_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
{
    return $this->belongsTo(department::class);
}
}
