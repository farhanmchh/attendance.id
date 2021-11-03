<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class StudentController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  private $title = 'Student';

  public function index()
  {
    return view('admin.student.index', [
      'title' => $this->title,
      'students' => Student::with('classroom')->orderBy('name', 'asc')->get()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.student.create', [
      'title' => $this->title,
      'classes' => Classroom::orderBy('name', 'asc')->get()
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
    $student = $request->validate([
      'name' => ['required', 'max:255'],
      'nisn' => ['required', 'numeric', 'unique:students,nisn'],
      'classroom_id' => ['required'],
      'address' => ['required']
    ]);
    $student['slug'] = SlugService::createSlug(Student::class, 'slug', $request->name);

    Student::create($student);

    return redirect('/student')->with('success', "{$request->name} successfully added!");
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Student $student)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($slug)
  {
    return view('admin.student.edit', [
      'title' => $this->title,
      'classes' => Classroom::orderBy('name', 'asc')->get(),
      'student' => Student::where('slug', $slug)->first()
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $slug)
  {
    $student = Student::where('slug', $slug)->first();
    $student->delete();
    
    $studentData = $request->validate([
      'name' => ['required', 'max:255'],
      'nisn' => ['required', 'numeric', 'unique:students,nisn'],
      'classroom_id' => ['required'],
      'address' => ['required']
    ]);
    $studentData['slug'] = Str::slug($request->name);
    
    Student::create($studentData);

    return redirect('/student')->with('success', "{$request->name} successfully updated!");
  }
  
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($slug)
  {
    $student = Student::where('slug', $slug)->first();
    Student::where('slug', $slug)->delete();
    return back()->with('success', "{$student->name} successfully deleted!");
  }
}
