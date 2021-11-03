<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Teacher;
use App\Models\Student;
use Carbon\Carbon;

class AttendanceController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $teacher = Teacher::where('email', auth()->user()->email)->first();
    $students = Student::where('classroom_id', $teacher->classroom_id)->get();
    
    $today = Carbon::now()->format('l');

    foreach ($students as $student) {
      $last_absent = Carbon::parse($student->absent_at)->format('l');
      if ($last_absent != $today) {
        $student->absent_at = NULL;
        $student->absent_status = NULL;
        $student->save();
      }
    }

    if ($today == 'Saturday' || $today == 'Monday') {
      $weekend = true;
    }
    
    return view('user.attendance.index', [
      'title' => 'Attendance',
      'teacher' => $teacher,
      'weekend' => $weekend,
      'today_attendance' => Attendance::where('classroom_id', $teacher->classroom_id)->whereDate('created_at', date('Y-m-d'))->get(),
      'students' => Student::where('classroom_id', $teacher->classroom_id)->orderBy('name', 'asc')->get()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request, $slug)
  {
    $teacher = Teacher::where('email', auth()->user()->email)->first();
    $student = Student::where('slug', $slug)->first();
    $today = Carbon::now()->format('l');

    // if ($today == 'Saturday' || $today == 'Sunday') {
    //   return back()->with('error', "Today is $today, no need to be absent");
    // }

    $checkAttendance = Attendance::where('student_id', $student->id)->whereDate('created_at', date('Y-m-d'))->first();

    if ($checkAttendance) {
      return back()->with('error', "$student->name has been absent");
    }

    $attendance = [
      'classroom_id' => $teacher->classroom->id,
      'student_id' => $student->id,
      'status' => $request->status
    ];

    Attendance::create($attendance);

    $student->absent_at = Carbon::now()->format('Y-m-d H:i');
    $student->absent_status = $request->status;
    $student->save();

    if ($request->status == 'present') {
      $message = "$student->name is present";
    } else if ($request->status == 'permission') {
      $message = "$student->name is permission";
    } else {
      $message = "$student->name is not present";
    }
    return back()->with('success', $message);

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
