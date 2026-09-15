<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],

            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],  //Woks same that next line,
            // The practical difference is that Rule::unique(...) lets you customize things more easily, for example, ignoring the current user when editing.
            // Rule::unique('users', 'email')->ignore($user->id)
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8', 'max:255'], // Add 'confirmed' if password_confirmation is needed
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // Don't need add Hash, because password is cast hash by default
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'You have been registered');
    }
}
