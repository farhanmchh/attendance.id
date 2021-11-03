<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classroom;
use App\Models\Attendance;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
  use HasFactory, SoftDeletes, Sluggable;

  protected $guarded = ['id'];
  protected $table = 'students';

  public function classroom()
  {
    return $this->belongsTo(Classroom::class);
  }

  public function attendance()
  {
    return $this->hasMany(Attendance::class);
  }
  
  public function getRouteName()
  {
    return 'slug';
  }

  public function sluggable(): array
  {
    return [
      'slug' => [
        'source' => 'name'
      ]
    ];
  }
}
