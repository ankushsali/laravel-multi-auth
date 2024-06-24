<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request) {
        if ($request->isMethod('POST')) {
            if (Auth::attempt($request->only('email', 'password'))) {
                if (auth()->user()->is_admin) {
                    return redirect()->route('admin.home');
                }
                Auth::logout();
            }
            return redirect()->route('admin.login')->with('error', 'Email or Passwor is wrong');
        }else{
            return view('admin.auth.login');
        }
    }
}
