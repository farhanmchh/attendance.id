<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
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

    switch ($day) {
      case 'Sunday':
        $regards = "Happy {$day}!";
        break;
      case 'Monday':
        $regards = "Cheers for {$day}!";
        break;
      case 'Tuesday':
        $regards = "Sweet smile for {$day}!";
        break;
      case 'Wednesday':
        $regards = "An excelent {$day}";
        break;
      case 'Thursday':
        $regards = "Have a sunny {$day}!";
        break;
      case 'Friday':
        $regards = "Have a blessed {$day}!";
        break;
      default:
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
      'email' => ['required'],
      'password' => ['required']
    ]);

    $request->remember ? $remember = true : $remember = false;

    if (Auth::attempt($user, $remember)) {
      $request->session()->regenerate();

      Teacher::where('email', $request->email)
        ->update(['sign_in' => Carbon::now()->format('Y-m-d H:i:s'), 'sign_out' => NULL]);

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
    Teacher::where('email', auth()->user()->email)
      ->update(['sign_in' => NULL, 'sign_out' => Carbon::now()->format('Y-m-d H:i:s')]);

    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'Bye!');
  }
}
