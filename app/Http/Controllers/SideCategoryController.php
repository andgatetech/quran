<?php

namespace App\Http\Controllers;

use App\Models\SideCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SideCategoryController extends Controller
{
    // Show the create side category form
    public function create()
    {
        return view('client.sidecategory.addsidecategory');
    }

    // Store a new side category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        SideCategory::create([
            'user_id' => Auth::id(), // ID of the logged-in user
            'name' => $request->name,
        ]);

        return redirect()->route('sidecategory.list')->with('success', 'Side Category created successfully!');
    }
    public function index()
    {
        $sideCategories = SideCategory::where('user_id', Auth::id())->get();
        return view('client.sidecategory.sidecategorylist', compact('sideCategories'));
    }

    // Set session for the side category to be edited
    public function setSession(Request $request)
    {
        $request->validate([
            'side_category_id' => 'required|exists:side_categories,id',
        ]);

        Session::put('side_category_id', $request->side_category_id);

        return redirect()->route('sidecategory.edit');
    }

    // Show edit form
    public function edit()
    {
        $sideCategoryId = Session::get('side_category_id'); // Retrieve the ID from the session

        if (!$sideCategoryId) {
            return redirect()->route('sidecategory.list')->with('error', 'No category selected for editing.');
        }

        // Fetch the side category
        $sideCategory = SideCategory::findOrFail($sideCategoryId);

        // Pass the data to the edit view
        return view('client.sidecategory.editsidecategory', compact('sideCategory'));
    }

    // Update the side category
    public function update(Request $request)
    {
        $sideCategoryId = Session::get('side_category_id');

        if (!$sideCategoryId) {
            return redirect()->route('sidecategory.list')->with('error', 'No category selected for updating.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $sideCategory = SideCategory::findOrFail($sideCategoryId);
        $sideCategory->update([
            'name' => $request->name,
        ]);

        Session::forget('side_category_id');

        return redirect()->route('sidecategory.list')->with('success', 'Side Category updated successfully!');
    }

    // Delete the side category
    public function destroy(Request $request)
    {
        $request->validate([
            'side_category_id' => 'required|exists:side_categories,id',
        ]);

        $sideCategory = SideCategory::findOrFail($request->side_category_id);
        $sideCategory->delete();

        return redirect()->route('sidecategory.list')->with('success', 'Side Category deleted successfully!');
    }


}
