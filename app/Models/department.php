<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
  /** @use HasFactory<\Database\Factories\DepartmentFactory> */
  use HasFactory;

  //nuwan had the table departments
  protected $table = 'departments';

  /** @var list<string> */
  protected $fillable = ['id', 'department', 'created_at', 'updated_at'];
}
