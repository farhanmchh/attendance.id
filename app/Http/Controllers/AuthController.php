<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
  public function index()
  {
    $day = Carbon::now()->format('l');
    $time = intval(Carbon::now()->format('H'));

    $bg = '';
    $bg_card = '';
    // $subRegards = '';
    if ($time >= 19 || $time <= 4) {
      $bg = '#3C3F58';
      $bg_card = '#707793';
      // $subRegards = "Have a good rest :)";
    }

    if ($day == 'Sunday') {
      $regards = "Happy {$day}!";
    } else if ($day == 'Monday') {
      $regards = "Cheers for {$day}!";
    } else if ($day == 'Tuesday') {
      $regards = "Sweet smile for {$day}!";
    } else if ($day == 'Wednesday') {
      $regards = "An excelent {$day}";
    } else if ($day == 'Thursday') {
      $regards = "Have a sunny {$day}!";
    } else if ($day == 'Friday') {
      $regards = "Have a blessed {$day}!";
    } else {
      $regards = "Sweet {$day}!";
    }

    return view('login.index', [
      'title' => 'Attandance.id | Log in',
      'bg' => $bg,
      'bg_card' => $bg_card,
      'regards' => $regards,
      // 'subRegards' => $subRegards
    ]);
  }

  public function authenticate(Request $request)
  {
    $user = $request->validate([
      'email'=> ['required'],
      'password' => ['required']
    ]);

    $request->remember ? $remember = true : $remember = false;
    
    if (Auth::attempt($user, $remember)) {
      $request->session()->regenerate();

      if (auth()->user()->role == 'master') {
        return redirect('/dashboard');
      } else {
        return redirect('/attendance');
      }
    }

    return back()->with('error', 'Error log-in!');
  }
  
  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'Bye!');
  }
}
