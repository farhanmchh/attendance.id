<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClassroomController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  private $title = 'Class';

  public function index()
  {
    return view('admin.classroom.index', [
      'title' => $this->title,
      'classes' => Classroom::orderBy('name', 'asc')->get()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.classroom.create', [
      'title' => $this->title,
      'teachers' => Teacher::doesntHave('classroom')->where('account', 1)->get()
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
    $class = $request->validate([
      'name' => ['required', 'max:255'],
      'teacher_id' => []
    ]);
    $class['slug'] = Str::slug($request->name);

    $class = Classroom::create($class);

    if ($request->teacher_id) {
      $teacher = Teacher::find($request->teacher_id);
      $teacher->classroom_id = $class->id;
      $teacher->save();
    }

    return redirect('/classroom')->with('success', "{$request->name} successfully created!");
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Classroom $classroom)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Classroom $classroom)
  {
    return view('admin.classroom.edit', [
      'title' => $this->title,
      'teachers' => Teacher::where('account', 1)->doesntHave('classroom')->get(),
      'class' => Classroom::where('slug', $classroom->slug)->first()
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Classroom $classroom)
  {
    $class = $request->validate([
      'name' => ['required', 'max:255'],
      'teacher_id' => []
    ]);
    if (!$request->teacher_id) {
      $class['teacher_id'] = $request->old_teacher_id;
    }
    $class['slug'] = Str::slug($request->name);

    $class = Classroom::updateOrCreate(['slug' => $classroom->slug], $class);

    $new_teacher = Teacher::find($class['teacher_id']);
    $new_teacher->classroom_id = $class->id;
    $new_teacher->save();
    
    $old_teacher = Teacher::find($classroom->teacher_id);
    $old_teacher->classroom_id = NULL;
    $old_teacher->save();

    return redirect('/classroom/' . $class['slug'] . '/edit')->with('success', 'Class successfully updated!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Classroom $classroom)
  {
    //
  }
}
