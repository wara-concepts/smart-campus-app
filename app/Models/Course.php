<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'code', 
        'description',
        'credits'
    ];

    // Relationship: A Course has many Timetables
    public function timetables()
    {
        return $this->hasMany(Timetable::class, 'course_id');
    }

    // If courses belong to users (instructors, admins, etc.)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
