<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    
    protected $table = 'lecturer';
    protected $primaryKey = 'lecturer_id';
    
    protected $fillable = [
        'lecturer_id',
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

    public function department()
{
    return $this->belongsTo(department::class);
}
}
