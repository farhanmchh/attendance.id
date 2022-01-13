<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
  use HasFactory, SoftDeletes;

  protected $guarded = ['id'];
  protected $table = 'classrooms';

  public function teacher()
  {
    return $this->hasOne(Teacher::class);
  }

  public function student()
  {
    return $this->hasMany(Student::class)->orderBy('name', 'asc');
  }

  public function getRouteKeyName()
  {
    return 'slug';
  }
}
