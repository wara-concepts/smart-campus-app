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
        'materials' 
    ];

    protected $casts = [
        'materials' => 'array',
    ];

    // // Define the relationship with LearningOutcome
    // public function learningOutcomes()
    // {
    //     return $this->hasMany(LearningOutcome::class);
    // }

    // Define the relationship with Material
    public function materials()
    {
        return $this->hasMany(Material::class);
    }
}
