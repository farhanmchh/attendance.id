<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Exports\StudentExport;
use App\Imports\ImportStudent;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  private $title = 'Student',
    $role  = 'master';

  public function index()
  {
    if (auth()->user()->role == $this->role) {

      if (request('filter')) {
        $students = Student::with('classroom')->filter(request(['filter']))->orderBy('name', 'asc');
        $count = $students->count();
        $students = $students->get();
        $class_name = 1;

        $numbering = 0;
      } else if (!request('filter') || request('filter') == '') {
        $students = Student::with('classroom')->orderBy('name', 'asc');
        $count = $students->count();
        $students = $students->paginate(7);
        $class_name = 0;

        $numbering = (($students->currentPage() - 1) * $students->perPage());
      }

      return view('admin.student.index', [
        'title' => $this->title,
        'count' => $count,
        'classes' => Classroom::orderBy('name', 'asc')->get(),
        'class_name' => $class_name,
        'numbering' => $numbering,
        'students' => $students
      ]);
    } else {
      return back();
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    if (auth()->user()->role == $this->role) {
      return view('admin.student.create', [
        'title' => $this->title,
        'classes' => Classroom::orderBy('name', 'asc')->get()
      ]);
    } else {
      return back();
    }
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
      'nis' => ['required', 'numeric', 'unique:students,nis'],
      'classroom_id' => ['required'],
      'address' => ['required']
    ]);
    $student['slug'] = SlugService::createSlug(Student::class, 'slug', $request->name);
    $student['name'] = Str::title($request->name);

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
    if (auth()->user()->role == $this->role) {
      return view('admin.student.edit', [
        'title' => $this->title,
        'classes' => Classroom::orderBy('name', 'asc')->get(),
        'student' => Student::where('slug', $slug)->first()
      ]);
    } else {
      return back();
    }
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
    // return response()->json('ok');
    $studentData = $request->validate([
      'name' => ['required', 'max:255'],
      'nis' => ['required', 'numeric'],
      'classroom_id' => ['required'],
      'address' => ['required']
    ]);
    $studentData['slug'] = SlugService::createSlug(Student::class, 'slug', $request->name);

    $check_students = Student::where('slug', '!=', $slug)->get();

    foreach ($check_students as $check_student) {
      if ($check_student->nis == $request->nis) {
        return redirect("/student/$slug/edit")->with('error_nisn', 'NIS has been taken')->withInput();
      }
    }

    Student::where('slug', $slug)->update($studentData);

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
    if (auth()->user()->role == $this->role) {
      $student = Student::where('slug', $slug)->first();
      Student::where('slug', $slug)->delete();
      return redirect('/student')->with('success', "{$student->name} successfully deleted!");
    } else {
      return back();
    }
  }

  public function filteringStudent($slug)
  {
    $classroom = Classroom::where('slug', $slug)->first();
    $students = Student::where('classroom_id', $classroom->id)
      ->orderBy('name', 'asc')
      ->get()
      ->load('classroom');

    return $students;
  }

  public function exportStudent()
  {
    return Excel::download(new StudentExport, 'student-template.xlsx');
  }

  public function importStudent(Request $request)
  {
    // Excel::import(new StudentExport, 'import-student.xlsx');

    // return back();
    $array = Excel::toArray(new ImportStudent, $request->file('importFile'));
    return response()->json($array);
  }
}
