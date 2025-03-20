<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student';
    
    protected $fillable = [
        'id',
        'user_id',
        'full_name',
        'nic',
        'dob',
        'address',
        'phone_number',
        'course_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
{
    return $this->belongsTo(Course::class);
}
}

