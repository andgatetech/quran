<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ClientAuthController extends Controller
{
    public function showLogin()
    {
        if(Auth::guard('client')->check()){
            return redirect()->route('client.menu');
        }
        return view('client.login');
    }

    public function login(Request $request)
    {
        
        
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $user = User::where('email', $request->email)->first();

        if ($user && $user->user_role === 'client' && Auth::guard('client')->attempt($credentials)) {
            return redirect()->route('client.menu');
        }

        //return back()->with('error', 'Invalid credentials');
        return back()->withErrors(['message' => 'Invalid credentials']);
        // return redirect()->route('client.login')->with('error', 'Invalid credentials');
    }

    public function logout(Request $request)
    {
        Auth::guard('client')->logout();
        return redirect()->route('welcome')->with('success', 'Logged out');
    }
}
