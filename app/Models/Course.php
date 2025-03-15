<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;


    //Table columns
    protected $fillable = ['id','department_id','course']; 

    // Table name
    protected $table = 'courses';

    // Relationship (if students belong to a course)
    public function students()
    {
        return $this->hasMany(Student::class);

    }
}
