<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Teacher;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    User::create([
      'name' => 'Master',
      'email' => 'master@attendance.id',
      'role' => 'master',
      'password' => bcrypt('asetsekolah')
    ]);
    User::create([
      'name' => 'Mochamad Farhan',
      'email' => 'moch.farhan04@gmail.com',
      'role' => 'teacher',
      'password' => bcrypt('farhan')
    ]);

    Teacher::create([
      'name' => 'Mochamad Farhan',
      'slug' => 'mochamad-farhan',
      'email' => 'moch.farhan04@gmail.com',
      'nip' => '1019009090',
      'address' => 'bogor',
      'account' => true,
      'classroom_id' => '1'
    ]);

    Classroom::create([
      'name' => 'XII RPL 1',
      'slug' => 'xii-rpl-1',
      'teacher_id' => '1'
    ]);
  }
}
