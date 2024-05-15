<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');
        // "remember me" functionality works differently than other form fields like email and password. 
        // This field is optional and is used to determine whether to create a persistent login session (a "remember me" cookie)
        // so sometimes when it checked it sent in the request, but if not it won't be sent at all ! 

        if (Auth::attempt($credentials, $remember)) {
            // intended -> this returns you to the specific page that you asked when you were not logged in
            // and if there is no page that you asked before then (/) returns you to the main page
            return redirect()->intended('/');
        } else {
            return redirect()->back()
                ->with('error', 'Invalid credentials');
        }
    }

    public function destroy() // logout
    {
        Auth::logout(); // line logs out the currently authenticated user by removing their authentication information from the session.

        request()->session()->invalidate(); // invalidates the current user session, old session cannot be reused

        request()->session()->regenerateToken(); // regenerates the CSRF (Cross-Site Request Forgery) token A new CSRF token is generated
        // and stored in the session. This is important for maintaining the security of the application by ensuring that any subsequent form submissions are protected with a fresh, valid token.

        return redirect('/');
    }
}