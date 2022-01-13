<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LogController extends Controller
{
  public function index()
  {
    return view('admin.log.index', [
      'title' => 'Log Activity',
      'teachers' => Teacher::orderBy('sign_in', 'desc')->get()
    ]);
  }
}
