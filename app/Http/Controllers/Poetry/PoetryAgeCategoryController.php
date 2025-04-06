<?php

namespace App\Http\Controllers\Poetry;

use App\Models\AgeCategory;
use App\Models\CompetitionType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PoetryAgeCategoryController extends Controller
{
    
    private $module = "Poetry";
    // Show the create form
    public function create()
    {
        return view('client.poetry.agecategory.create');
    }

    // Store a new age category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $competitionType = CompetitionType::where('name', 'Poetry')->first();

        AgeCategory::create([
            'competition_type_id' => $competitionType->id,
            'user_id' => Auth::id(), // ID of the logged-in user
            'name' => $request->name,
        ]);

        return redirect()->route('poetry.agecategory.index')->with('success', 'Age Category created successfully!');
    }

    // List all age categories
    public function index()
    {
        $competitionType = CompetitionType::where('name', 'Poetry')->first();
        $ageCategories = AgeCategory::where('user_id', Auth::id())
        ->where('competition_type_id',$competitionType->id)
        ->get();
        return view('client.poetry.agecategory.list', compact('ageCategories'));
    }

    // Edit an age category
    public function edit($id)
    {

        $ageCategory = AgeCategory::findOrFail($id);
        if (!$ageCategory) {
            return redirect()->route('poetry.agecategory.index')->with('error', 'No category selected for editing.');
        }

        return view('client.poetry.agecategory.edit', compact('ageCategory'));
    }


    // Update an age category
    public function update($id,Request $request)
{
    
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $ageCategory = AgeCategory::findOrFail($id);
    $ageCategory->update([
        'name' => $request->name,
    ]);
    
    return redirect()->route('poetry.agecategory.index')->with('success', 'Age Category updated successfully!');
}

    // Delete an age category
    public function destroy($id)
    {
        // Find the AgeCategory by ID
        $ageCategory = AgeCategory::findOrFail($id);
        // Delete the AgeCategory
        $ageCategory->delete();
        // Redirect with success message
        return redirect()->route('poetry.agecategory.index')->with('success', 'Age Category deleted successfully!');
    }

    

}
