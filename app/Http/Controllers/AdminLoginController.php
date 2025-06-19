<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

   public function login(Request $request)
{

    // Debugging admin login
    $hashedPassword = Hash::make($request->password); // Generates a new hash (not useful for matching)
$storedPassword = Admin::where('email', $request->email)->value('password');

if (Hash::check($request->password, $storedPassword)) {
    Log::info('Admin authenticated successfully.', ['email' => $request->email]);
} else {
    Log::warning('Password mismatch for admin.', ['email' => $request->email]);
}



    $credentials = $request->only('email', 'password');

    if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();
        Log::info('Admin logged in successfully.', ['email' => $request->email]);

        return redirect()->intended(route('admin.dashboard'));
    } 
    
    
    else {
        
        Log::warning('Login attempt failed.', ['email' => $request->email]);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        Log::info('Dashboard method accessed.');
        return view('admin.dashboard'); 
    }
}
