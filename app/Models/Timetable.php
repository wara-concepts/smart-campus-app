<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'day', 'start_time', 'end_time', 'instructor', 'location'];

    // Define the relationship: A Timetable belongs to a Course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
