<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
  public function index()
  {
    $time = intval(Carbon::now()->format('H'));

    if ($time >= 6 && $time <= 11) {
      $regards = "Have a good day :)";
    } else if ($time >= 12 && $time <= 18) {
      $regards = "Don't forget to drink water :)";
    } else if ($time >= 19 && $time <= 24) {
      $regards = "Don't forget to rest :)";
    } else {
      $regards = "Ssstt!";
    }

    return view('dashboard.index', [
      'title' => 'Dashboard',
      'regards' => $regards
    ]);
  }
}
