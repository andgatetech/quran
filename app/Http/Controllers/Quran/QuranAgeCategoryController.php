<?php

namespace App\Http\Controllers\Quran;

use App\Models\AgeCategory;
use App\Models\CompetitionType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QuranAgeCategoryController extends Controller
{
    private $module = "Quran";
    private $competitionType;

    public function __construct(){
        // find competition type;
        $this->competitionType = CompetitionType::where('name', 'Quran')->first();
    }
    // Show the create form
    public function create()
    {
        return view('client.quran.agecategory.create');
    }

    // Store a new age category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        AgeCategory::create([
            'competition_type_id' => $this->competitionType->id,
            'user_id' => Auth::guard('client')->id(), // ID of the logged-in user
            'name' => $request->name,
        ]);

        return redirect()->route('quran.agecategory.index')->with('success', 'Age Category created successfully!');
    }

    // List all age categories
    public function index()
    {
        $ageCategories = AgeCategory::where([
            ['user_id', '=', Auth::guard('client')->id()],
            ['competition_type_id', '=', $this->competitionType->id],
        ])->get();
        return view('client.quran.agecategory.list', compact('ageCategories'));
    }

    // Edit an age category
    public function edit($id)
    {
        $ageCategory = AgeCategory::findOrFail($id);

        if (!$ageCategory) {
            return redirect()->route('quran.agecategory.index')->with('error', 'No category selected for editing.');
        }

        return view('client.quran.agecategory.edit', compact('ageCategory'));
    }


    // Update an age category
    public function update($id,Request $request)
{
    $ageCategory = AgeCategory::findOrFail($id);

    if (!$ageCategory) {
        return redirect()->route('quran.agecategory.index')->with('error', 'No category selected for updating.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $ageCategory->update([
        'name' => $request->name,
    ]);

    return redirect()->route('quran.agecategory.index')->with('success', 'Age Category updated successfully!');
}

    // Delete an age category
    public function destroy($id)
    {
        // Find the AgeCategory by ID
        $ageCategory = AgeCategory::findOrFail($id);

        // Delete the AgeCategory
        $ageCategory->delete();

        // Redirect with success message
        return redirect()->route('quran.agecategory.index')->with('success', 'Age Category deleted successfully!');
    }

}
