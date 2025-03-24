<?php

namespace App\Http\Controllers;

use App\Models\ReadCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReadCategoryController extends Controller
{
    // Show the create form
    public function create()
    {
        return view('client.readcategory.create');
    }

    // Store the read category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ReadCategory::create([
            'user_id' => Auth::id(), // ID of the logged-in user
            'name' => $request->name,
        ]);

        return redirect()->route('readcategory.list')->with('success', 'Read Category created successfully!');
    }

    // List all read categories
    public function index()
    {
        $readCategories = ReadCategory::where('user_id', Auth::id())->get();
        return view('client.readcategory.list', compact('readCategories'));
    }

    // Set session for editing
    public function setSession(Request $request)
    {
        $request->validate([
            'read_category_id' => 'required|exists:read_categories,id',
        ]);

        Session::put('read_category_id', $request->read_category_id);

        return redirect()->route('readcategory.edit');
    }

    // Show edit form
    public function edit()
    {
        $readCategoryId = Session::get('read_category_id');

        if (!$readCategoryId) {
            return redirect()->route('readcategory.list')->with('error', 'No category selected for editing.');
        }

        $readCategory = ReadCategory::findOrFail($readCategoryId);
        return view('client.readcategory.edit', compact('readCategory'));
    }

    // Update the read category
    public function update(Request $request)
    {
        $readCategoryId = Session::get('read_category_id');

        if (!$readCategoryId) {
            return redirect()->route('readcategory.list')->with('error', 'No category selected for updating.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $readCategory = ReadCategory::findOrFail($readCategoryId);
        $readCategory->update([
            'name' => $request->name,
        ]);

        Session::forget('read_category_id');

        return redirect()->route('readcategory.list')->with('success', 'Read Category updated successfully!');
    }

    // Delete a read category
    public function destroy(Request $request)
    {
        $request->validate([
            'read_category_id' => 'required|exists:read_categories,id',
        ]);

        $readCategory = ReadCategory::findOrFail($request->read_category_id);
        $readCategory->delete();

        return redirect()->route('readcategory.list')->with('success', 'Read Category deleted successfully!');
    }
}
