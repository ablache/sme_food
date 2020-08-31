<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\User;
use Auth;

class LoginController extends Controller
{
  public function getLogin() {
    return view('login');
  }

  public function postLogin(LoginRequest $request) {
    $user = User::where('email', $request->email)->first();

    if(is_null($user)) {
      return redirect()->back()->withErrors(['user' => 'Invalid credentials!'])->withInput();
    }

    if(Auth::attempt($request->only('email', 'password'))) {
      return redirect()->route('dashboard');
    }

    return redirect()->back()->withErrors(['user' => 'Invalid credentials'])->withInput();
  }

  public function logout() {
    Auth::logout();

    return redirect()->route('login');
  }
}
