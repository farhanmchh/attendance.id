<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Teacher;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;

class ReportController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  private $title = 'Report',
          $role  = 'teacher';
  public function index()
  {
    $teacher = Teacher::where('email', auth()->user()->email)->first();

    if (auth()->user()->role == $this->role) {
      return view('user.report.index', [
        'title' => $this->title,
        'teacher' => $teacher,
        'student' => Student::where('classroom_id', $teacher->classroom_id)
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
   * @param  \App\Models\Report  $report
   * @return \Illuminate\Http\Response
   */
  public function show(Report $report)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Report  $report
   * @return \Illuminate\Http\Response
   */
  public function edit(Report $report)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Report  $report
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Report $report)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Report  $report
   * @return \Illuminate\Http\Response
   */
  public function destroy(Report $report)
  {
    //
  }

  public function getAttendanceReport($classroom_id, $date)
  {
    if (auth()->user()->role == $this->role) {
      $reports = Attendance::where('classroom_id', $classroom_id)->whereDate('created_at', $date)->get();
      
      foreach ($reports as $key => $report) {
        $reports[$key]->student = $report->student;
      }
  
      return $reports;
    } else {
      return back();
    }
  }
}
