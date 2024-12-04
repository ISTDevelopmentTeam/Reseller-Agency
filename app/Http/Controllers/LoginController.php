<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{


    public function login(Request $request)
    {
        // Attempt to authenticate the user
        if (Auth::attempt($request->only('username', 'password'))) {


            session()->put('user_id', Auth::id());
            session()->put('username', Auth::user()->username);
            session()->put('roles', Auth::user()->roles);


            // If successful, redirect to the intended page or default dashboard
            return response()->json(['redirect' => route('dashboard')]); // Return JSON with the redirect URL

        }

        // If authentication fails, return a response that can trigger SweetAlert
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid username or password'
        ]);
    }



    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Logged out successfully!');
    }
}
