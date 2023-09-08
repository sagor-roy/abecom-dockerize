<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login_show()
    {
        if (auth('web')->check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function do_login(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            if (auth('web')->user()->is_active == false) {
                Auth::logout();
                $request->session()->flash('failed', 'Your account is deactivated');

                return redirect()->route('login.show');
            }

            return redirect()->route('dashboard');
        } else {
            $request->session()->flash('failed', 'Invalid credentials');

            return back();
        }
    }
}
