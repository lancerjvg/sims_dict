<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login authentication directly.
     *
     * Handles:
     * - Email and password validation
     * - Remember Me
     * - Inactive account protection
     * - Session regeneration
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate login inputs
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Find user using email
        $user = User::where('email', $validated['email'])->first();

        // Generic error for invalid credentials
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return back()
                ->withErrors([
                    'email' => 'Invalid email address or password.',
                ])
                ->withInput($request->only('email'));
        }

        // BLOCK INACTIVE ACCOUNTS
        if ($user->status !== 'Active') {
            return back()
                ->withErrors([
                    'email' => 'Your account is inactive. Please contact the system administrator.',
                ])
                ->withInput($request->only('email'));
        }

        // Attempt authentication and support Remember Me
        $remember = $request->boolean('remember');

        if (!Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password'],
        ], $remember)) {
            return back()
                ->withErrors([
                    'email' => 'Invalid email address or password.',
                ])
                ->withInput($request->only('email'));
        }

        // Regenerate session after successful login
        $request->session()->regenerate();

        // Redirect to intended page or Dashboard
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}