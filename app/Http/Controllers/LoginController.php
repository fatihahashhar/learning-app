<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display the login form
     */
    public function login()
    {
        return view('user/login');
    }

    /**
     * Authenticate the login details
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        //Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Check the user's role
            $user = Auth::user();
            if ($user->role === 'admin') {
                // User is an admin, route to 'courses.index'
                return redirect()->route('courses.index', $user->id)->with('success', 'Login successful');
            } else {
                // User is not an admin, route to 'normalUsers.dashboard'
                return redirect()->route('normalUsers.dashboard', ['user' => $user->id])
                    ->with('success', 'Login successful');
            }
        }

        return redirect()->route('login')->with('error', 'Login details are not valid');
    }

    /**
     * Handle logout action
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout successful');
    }
}
