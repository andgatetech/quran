<?php

namespace App\Http\Controllers\Poetry;

use App\Models\ReadCategory;
use App\Models\CompetitionType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PoetryReadCategoryController extends Controller
{
    private $module = "Poetry";
    // Show the create form
    public function create()
    {
        return view('client.poetry.readcategory.create');
    }

    // Store the read category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $competitionType = CompetitionType::where('name', 'Poetry')->first();
        ReadCategory::create([
            'competition_type_id' => $competitionType->id,
            'user_id' => Auth::id(), // ID of the logged-in user
            'name' => $request->name,
        ]);

        return redirect()->route('poetry.readcategory.list')->with('success', 'Read Category created successfully!');
    }

    // List all read categories
    public function index()
    {
        $competitionType = CompetitionType::where('name', 'Poetry')->first();
        $readCategories = ReadCategory::where('user_id', Auth::id())
        ->where('competition_type_id',$competitionType->id)
        ->get();
        return view('client.poetry.readcategory.list', compact('readCategories'));
    }

    

    // Show edit form
    public function edit($id)
    {
        $readCategory = ReadCategory::findOrFail($id);
        if (!$readCategory) {
            return redirect()->route('readcategory.list')->with('error', 'No category selected for editing.');
        }
        return view('client.poetry.readcategory.edit', compact('readCategory'));
    }

    // Update the read category
    public function update($id,Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $readCategory = ReadCategory::findOrFail($id);
        $readCategory->update([
            'name' => $request->name,
        ]);
        return redirect()->route('poetry.readcategory.list')->with('success', 'Read Category updated successfully!');
    }

    // Delete a read category
    public function destroy($id)
    {
        $readCategory = ReadCategory::findOrFail($id);
        $readCategory->delete();
        return redirect()->route('poetry.readcategory.list')->with('success', 'Read Category deleted successfully!');
    }
}
