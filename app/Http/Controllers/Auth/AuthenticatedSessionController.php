<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $user = auth()->user();
        $request->session()->regenerate();
        
        // public function redirectTo(){
    
            

      
      if ($user->role === 'teacher') {
            return redirect('/teachers/teacherdashboard');
        } elseif ($user->role === 'student') {
            return redirect('/students/studentdashboard');
        } elseif ($user->role === 'admin') {
            return redirect('/admin/admindashboard');
        }

        return redirect('/dashboard');
    }

        // return redirect()->intended(route('dashboard', absolute: false));
    

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