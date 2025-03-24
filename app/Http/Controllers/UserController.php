<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function index()
    {
        return view('admin.index');
    }

    public function create()
    {
        return view('admin.create');
    }
    public function list()
    {
        $users = User::all();
        return view('admin.list', compact('users'));
    }
















    public function edit($id)
{
    $user = User::findOrFail($id);
    return view('admin.edit', compact('user'));
}


public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_role' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'address' => 'required|string',
            'company_name' => 'required|string|max:255',
        ]);

        $user = new User();
        $user->user_name = $validated['user_name'];
        $user->user_role = $validated['user_role'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->address = $validated['address'];
        $user->company_name = $validated['company_name'];
        $user->save();

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->with('error', 'Failed to create user: ' . $e->getMessage());
    }
}

public function update(Request $request, $id)
{
    try {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_role' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id . ',id',
            'password' => 'nullable|string|min:6',
            'address' => 'required|string',
            'company_name' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->user_name = $validated['user_name'];
        $user->user_role = $validated['user_role'];
        $user->email = $validated['email'];
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }
        $user->address = $validated['address'];
        $user->company_name = $validated['company_name'];
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->with('error', 'Failed to update user: ' . $e->getMessage());
    }
}



public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('users.index')->with('success', 'User deleted successfully!');
}




public function toggleStatus($id)
{
    $user = User::findOrFail($id);
    $user->status = $user->status === 'active' ? 'deactive' : 'active';
    $user->save();

    $message = $user->status === 'active' ? 'User activated successfully!' : 'User deactivated successfully!';
    return redirect()->route('users.index')->with('success', $message);
}






public function login(Request $request)
{
    // Validate input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Find the user by email and ensure the role is 'admin'
    $user = User::where('email', $request->email)
                ->where('user_role', 'admin')
                ->first();

    // Verify if the user exists and the password matches
    if ($user && Hash::check($request->password, $user->password)) {
        // Log the user in
        Auth::login($user);

        return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
    }

    // Redirect back with an error message if login fails
    return back()->withErrors(['error' => 'Invalid credentials or not authorized.']);
}


   public function logout()
    {
        Auth::logout();

        return redirect()->route('admin.index')->with('success', 'Logged out successfully!');
    }
}
