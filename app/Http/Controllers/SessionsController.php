<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SessionsController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required', 'email', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ]);

        if (! Auth::attempt($attributes)) {
            return back()
                ->withErrors([
                    'password' => 'We were unable to authenticate using the provided credentials.',
                ])
                ->withInput();
        }
        $request->session()->regenerate();

        return redirect()->intended('/')->with('success', 'You have successfully logged in.');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/')->with('success', 'You have been logged out!');
    }
}
