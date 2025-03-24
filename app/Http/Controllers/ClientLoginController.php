<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClientLoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('client.login'); // Path to your Blade file
    }

    // Handle login request
    public function login(Request $request)
    {
        Log::info('Login attempt for email: ' . $request->email);

        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to find the user by email
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Check if the user role is 'user' and the status is 'active'
            if ($user->user_role === 'user' && $user->status === 'active') {
                // Authenticate the user
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    Log::info('Authentication successful for email: ' . $request->email);
                    $request->session()->regenerate();

                    return redirect()->route('client.menu');
                }
                Log::warning('Authentication failed for email: ' . $request->email);
                return redirect()->back()->withErrors(['password' => 'Invalid password'])->withInput();
            }

            // Log and return error if user role or status doesn't match
            if ($user->status !== 'active') {
                Log::warning('Inactive account for email: ' . $request->email);
                return redirect()->back()->withErrors(['email' => 'Account is inactive. Please contact support.'])->withInput();
            }
            Log::warning('Unauthorized role for email: ' . $request->email);
            return redirect()->back()->withErrors(['email' => 'Unauthorized role.'])->withInput();
        }

        Log::warning('User not found for email: ' . $request->email);
        return redirect()->back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }


}
