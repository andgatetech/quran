<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\AgeCategory;
use App\Models\Competition;
use App\Models\ReadCategory;
use App\Models\SideCategory;
use App\Models\Curriculum;


class CurriculumController extends Controller
{
    public function index()
{
    // Fetch curriculum data along with related models
    $curriculums = Curriculum::with([
        'competition',
        'sideCategory',
        'readCategory',
        'ageCategory'
    ])
    ->where('user_id', Auth::id())  // Filter by the currently authenticated user
    ->get();

    // Pass the data to the view
    return view('client.curriculum.list', compact('curriculums'));
}


    public function create()
    {
        $competitions = Competition::where('user_id', Auth::id())->get();
        $sideCategories = SideCategory::where('user_id', Auth::id())->get();
        $readCategories = ReadCategory::where('user_id', Auth::id())->get();
        $ageCategories = AgeCategory::where('user_id', Auth::id())->get();

        return view('client.curriculum.create', compact('competitions', 'sideCategories', 'readCategories', 'ageCategories'));
    }


    public function store(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'title' => 'required|string|max:255',
        'number_of_questions' => 'nullable|integer',
        'total_ayah' => 'nullable|integer',
        'competition_id' => 'nullable|exists:competitions,id',
        'side_category_id' => 'nullable|exists:side_categories,id',
        'read_category_id' => 'nullable|exists:read_categories,id',
        'age_category_id' => 'nullable|exists:age_categories,id',
        'remarks' => 'nullable|string|max:1000',
    ]);

    // Create the Curriculum record in the database
    Curriculum::create([
        'title' => $request->input('title'),
        'number_of_questions' => $request->input('number_of_questions'),
        'total_ayah' => $request->input('total_ayah'),
        'competition_id' => $request->input('competition_id'),
        'side_category_id' => $request->input('side_category_id'),
        'read_category_id' => $request->input('read_category_id'),
        'age_category_id' => $request->input('age_category_id'),
        'remarks' => $request->input('remarks'),
        'user_id' => Auth::id(),
    ]);

    // Redirect back to the form with a success message
    return redirect()->route('curriculum.create')->with('success', 'Curriculum has been added successfully!');
}




public function edit($id)
{
    $curriculum = Curriculum::findOrFail($id);
    // Optionally load the related data if needed
    $competitions = Competition::where('user_id', Auth::id())->get();
    $sideCategories = SideCategory::where('user_id', Auth::id())->get();
    $readCategories = ReadCategory::where('user_id', Auth::id())->get();
    $ageCategories = AgeCategory::where('user_id', Auth::id())->get();

    return view('client.curriculum.edit', compact('curriculum', 'competitions', 'sideCategories', 'readCategories', 'ageCategories'));
}



public function update(Request $request, $id)
{
    $curriculum = Curriculum::findOrFail($id);

    // Validate the incoming request data
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'number_of_questions' => 'nullable|integer',
        'total_ayah' => 'nullable|integer',
        'competition_id' => 'nullable|exists:competitions,id',
        'side_category_id' => 'nullable|exists:side_categories,id',
        'read_category_id' => 'nullable|exists:read_categories,id',
        'age_category_id' => 'nullable|exists:age_categories,id',
        'remarks' => 'nullable|string|max:1000',
    ]);

    try {
        // Update the curriculum
        $curriculum->update($validatedData);

        // Redirect back with success message
        return redirect()->route('curriculum.index')->with('success', 'Curriculum updated successfully!');
    } catch (\Exception $e) {
        // Log the error
        \Log::error('Error updating curriculum: ' . $e->getMessage());

        // Redirect back with error message
        return redirect()->back()->with('error', 'Failed to update curriculum. Please try again.');
    }
}









public function destroy($id)
{
    // Find the curriculum by ID, or fail if it doesn't exist
    $curriculum = Curriculum::findOrFail($id);

    try {
        // Delete the curriculum
        $curriculum->delete();

        // Redirect to the curriculum index page with a success message
        return redirect()->route('curriculum.index')->with('success', 'Curriculum deleted successfully!');
    } catch (\Exception $e) {
        // Log any error that occurs during deletion
        \Log::error('Error deleting curriculum: ' . $e->getMessage());

        // Redirect to the curriculum index page with an error message
        return redirect()->route('curriculum.index')->with('error', 'Failed to delete curriculum. Please try again.');
    }
}


}
