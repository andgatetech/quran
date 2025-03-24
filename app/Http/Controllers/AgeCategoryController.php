<?php

namespace App\Http\Controllers;

use App\Models\AgeCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AgeCategoryController extends Controller
{
    // Show the create form
    public function create()
    {
        return view('client.agecategory.create');
    }

    // Store a new age category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        AgeCategory::create([
            'user_id' => Auth::id(), // ID of the logged-in user
            'name' => $request->name,
        ]);

        return redirect()->route('agecategory.index')->with('success', 'Age Category created successfully!');
    }

    // List all age categories
    public function index()
    {
        $ageCategories = AgeCategory::where('user_id', Auth::id())->get();
        return view('client.agecategory.list', compact('ageCategories'));
    }

    // Edit an age category
    public function edit()
    {
        $ageCategoryId = session('age_category_id'); // Get the ID from the session

        if (!$ageCategoryId) {
            return redirect()->route('agecategory.index')->with('error', 'No category selected for editing.');
        }

        $ageCategory = AgeCategory::findOrFail($ageCategoryId);

        return view('client.agecategory.edit', compact('ageCategory'));
    }


    // Update an age category
    public function update(Request $request)
{
    $ageCategoryId = session('age_category_id'); // Get the ID from the session

    if (!$ageCategoryId) {
        return redirect()->route('agecategory.index')->with('error', 'No category selected for updating.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $ageCategory = AgeCategory::findOrFail($ageCategoryId);
    $ageCategory->update([
        'name' => $request->name,
    ]);

    // Clear the session
    session()->forget('age_category_id');

    return redirect()->route('agecategory.index')->with('success', 'Age Category updated successfully!');
}

    // Delete an age category
    public function destroy($id)
    {
        // Find the AgeCategory by ID
        $ageCategory = AgeCategory::findOrFail($id);

        // Delete the AgeCategory
        $ageCategory->delete();

        // Redirect with success message
        return redirect()->route('agecategory.index')->with('success', 'Age Category deleted successfully!');
    }

    public function setSession(Request $request)
{
    $request->validate([
        'age_category_id' => 'required|exists:age_categories,id',
    ]);

    // Store the ID in the session
    session(['age_category_id' => $request->age_category_id]);

    return redirect()->route('agecategory.edit');
}

}
