<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use function Laravel\Prompts\alert;

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
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();
        $selectedRole = $request->role;


        // Add your conditional logic here
        // if (auth()->user()->role == 'admin') { // Check if the user is an admin
        //     return redirect()->intended('/admin/admindash'); // Redirect to admin dashboard
        // } else {
        //     return redirect()->intended(route('dashboard', absolute: false)); // Redirect to default user dashboard
        // }

        // return redirect()->intended(route('/user/dashboard/dashboard', absolute: false)); // Redirect to default user dashboard

        if ($selectedRole === 'admin') {
            $user;
            return redirect()->intended(route('admin.dashboard.dashboard'));
        } elseif ($selectedRole === 'user') {
            $user;
            return redirect()->intended(route('user.dashboard.dashboard'));
        } else {

            alert("Selected role is wrong");
            return redirect()->intended(route('login'));
        }

        //return redirect()->intended(route('user.dashboard.dashboard'));
        //return $selectedRole;
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
