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

    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:255',
            ],
        ]);

        if (!Auth::attempt($attributes)) {

            return back()
                ->withErrors(['password' => 'We were unable to authenticate using the provided credentials.'])
                ->onlyInput();
        }

        $request->session()->regenerate();

        return redirect()->intended('/')->with('success', 'You are now logged in.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        return redirect('/');
    }
}
