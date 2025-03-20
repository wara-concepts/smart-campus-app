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
        'credits',
    ]; 

    // Define the relationship with Material
    public function materials()
    {
        return $this->hasMany(Material::class, 'course_id');
    }
}
