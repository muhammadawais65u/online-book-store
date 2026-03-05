<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer', // Set default role for new users
        ]);

        event(new Registered($user));

        // Ensure user is properly authenticated
        Auth::login($user, true); // true for "remember me"

        // Check if user is actually authenticated
        if (Auth::check()) {
            // Redirect based on user role
            if ($user->isAdmin()) {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/customer/dashboard');
            }
        } else {
            // If authentication failed, redirect to login with error
            return redirect()->route('login')->with('error', 'Registration successful, but login failed. Please login manually.');
        }
    }
}
