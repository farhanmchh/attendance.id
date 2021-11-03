<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Mail;

class TeacherController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  private $title = 'Teacher';

  public function index()
  {
    return view('admin.teacher.index', [
      'title' => $this->title,
      'count' => Teacher::all()->count(),
      'teachers' => Teacher::with(['classroom'])->orderBy('name', 'asc')->get()
    ]);
  }
  
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.teacher.create', [
      'title' => $this->title
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $teacher_data = $request->validate([
      'name' => ['required', 'max:255'],
      'email' => ['email', 'max:255', 'unique:teachers,email'],
      'nip' => ['required', 'unique:teachers,nip'],
      'address' => ['required']
    ]);
    
    $teacher_data['slug'] = SlugService::createSlug(Teacher::class, 'slug', $request->name);
    
    if ($request->create_account_too) {
      $teacher_data['account'] = true;

      $user = $request->validate([
        'user_password' => ['required', 'min:8'],
        'repeat_user_password' => ['same:user_password']
      ]);

      $user['name'] = $request->name;
      $user['email'] = $request->email;
      $user['password'] = bcrypt($request->user_password);

      User::create($user);

      // $data = ['email' => $request->user_email, 'password' => $request->user_password];
      
      // Mail::send('teacher.mail', $data, function($mail) use ($request) {
      //   $mail->to($request->email)->subject('Authenticate for Attendance.id');
      //   $mail->from('system@attendance.id', 'Attendance.ID');
      // });
    } else $teacher_data['account'] = false;

    Teacher::create($teacher_data);

    return redirect('/teacher')->with('success', "{$request->name} successfully added!");
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Teacher $teacher)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Teacher $teacher)
  {
    return view('admin.teacher.edit', [
      'title' => $this->title,
      'user' => User::where('email', $teacher->email)->count(),
      'teacher' => Teacher::where('slug', $teacher->slug)->first()
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Teacher $teacher)
  {
    if ($request->create_account_too) {
      $teacherData['account'] = true;
      
      $user = $request->validate([
        'user_password' => ['min:8'],
        'repeat_user_password' => ['same:user_password']
      ]);

      $user['name'] = $request->name;
      $user['email'] = $request->email;
      $user['password'] = bcrypt($request->user_password);
      
      User::create($user);
    } else { $teacherData['account'] = false; }
    
    if ($request->account == 1) $teacher_data['account'] = true;
    
    $teacher_data = $request->validate([
      'name' => ['required', 'max:255'],
      'email' => ['max:255', 'email'],
      'nip' => ['required', 'numeric'],
      'address' => ['required']
    ]);
    $teacher_data['slug'] = SlugService::createSlug(Teacher::class, 'slug', $request->name);
    
    $check_teachers = Teacher::where('slug', '!=', $teacher->slug)->get();

    foreach ($check_teachers as $check_teacher) {
      if ($check_teacher->email == $request->email) {
        return redirect("/teacher/$teacher->slug/edit")->with('error_email', 'Email has been taken')->withInput();
      }
      if ($check_teacher->nip == $request->nip) {
        return redirect("/teacher/$teacher->slug/edit")->with('error_nip', 'NIP has been taken')->withInput();
      }
    }

    Teacher::where('slug', $teacher->slug)->update($teacher_data);

    return redirect("/teacher/{$teacher_data['slug']}/edit")->with('success', "{$teacher->name} successfully updated!");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Teacher $teacher)
  {
    $checkClass = Classroom::where('teacher_id', $teacher->id)->first();

    if ($checkClass) {
      return back()->with('error', 'This teacher is the homeroom teacher in one of the classes');
    }

    Teacher::find($teacher->id)->delete();
    return redirect('/teacher')->with('success', "{$teacher->name} successfully deleted!");
  }

  public function release($slug)
  {
    $teacher = Teacher::where('slug', $slug)->first();
    $teacher->classroom_id = NULL;
    $teacher->save();

    $classroom = Classroom::where('teacher_id', $teacher->id)->first();
    $classroom->teacher_id = NULL;
    $classroom->save();

    return redirect('/teacher/' . $teacher->slug . '/edit')->with('success', "$teacher->name has been released class $classroom->name");
  }
}
