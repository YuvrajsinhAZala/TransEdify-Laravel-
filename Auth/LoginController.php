<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'username' => ['Invalid credentials.'],
            ]);
        }

        // Get the raw password from database (bypassing the 'hashed' cast)
        $rawPassword = $user->getRawOriginal('password');
        
        // Check if password is plain text (not a Bcrypt hash)
        $isPlainText = !preg_match('/^\$2[ayb]\$.{56}$/', $rawPassword);
        
        if ($isPlainText) {
            // Password is plain text, check if it matches
            if ($rawPassword === $request->password) {
                // Password matches, hash it and update directly in DB
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['password' => Hash::make($request->password)]);
                
                // Manually log in the user after password upgrade
                Auth::login($user);
                $request->session()->regenerate();
                
                if ($user->role === 'admin') {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('student.dashboard');
                }
            } else {
                // Plain text password doesn't match
                throw ValidationException::withMessages([
                    'username' => ['Invalid credentials.'],
                ]);
            }
        }

        // Password is already hashed, use normal authentication
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('student.dashboard');
            }
        }

        throw ValidationException::withMessages([
            'username' => ['Invalid credentials.'],
        ]);
    }
}

