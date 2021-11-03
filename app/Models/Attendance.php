<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Attendance extends Model
{
  use HasFactory;

  protected $guarded = ['id'];
  protected $table = 'attendances';

  public function student()
  {
    return $this->belongsTo(Student::class);
  }

  public function getRouteName()
  {
    return 'slug';
  }
}
