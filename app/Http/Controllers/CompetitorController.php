<?php

namespace App\Http\Controllers;

use App\Models\Competitor;
use App\Models\AgeCategory;
use App\Models\Competition;
use App\Models\ReadCategory;
use App\Models\SideCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CompetitorsImport; // Add this line

class CompetitorController extends Controller
{




    public function bulkStore(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'competitors_csv' => 'required|mimes:csv,txt',
        ]);

        try {
            // Import the CSV using Laravel Excel
            Excel::import(new CompetitorsImport, $request->file('competitors_csv'));

            return redirect()->route('competitors.index')->with('success', 'Competitors imported successfully!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            // Collect error messages
            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = 'Row ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            }

            return redirect()->back()->with('error', 'Failed to import competitors.')->with('import_errors', $errorMessages);
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error importing competitors: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An unexpected error occurred during import.');
        }
    }
















































    /**
     * Display a listing of the competitors.
     */
    public function index()
    {
        $competitors = Competitor::with([
            'competition',
            'sideCategory',
            'readCategory',
            'ageCategory'
        ])->get();
        // ->where('user_id', Auth::id()) // Filter by user_id
        // ->get();

        return view('client.competitor.list', compact('competitors'));
    }



    /**
     * Show the form for creating a new competitor.
     */
    public function create()
    {
        $competitions = Competition::where('user_id', Auth::id())->get();
        $sideCategories = SideCategory::where('user_id', Auth::id())->get();
        $readCategories = ReadCategory::where('user_id', Auth::id())->get();
        $ageCategories = AgeCategory::where('user_id', Auth::id())->get();

        return view('client.competitor.create', compact('competitions', 'sideCategories', 'readCategories', 'ageCategories'));
    }

    /**
     * Store a newly created competitor in storage.
     */

public function store(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'full_name' => 'required',
        'full_name_dhivehi' => 'nullable',
        'id_card_number' => 'required',
        'address' => 'required',
        'island_city' => 'required',
        'school_name' => 'nullable',
        'parent_name' => 'required',
        'phone_number' => 'required',
        'competition_id' => 'required',
        'side_category_id' => 'required',
        'read_category_id' => 'required',
        'age_category_id' => 'required',
        'number_of_questions' => 'required',
        'full_name' => 'required',
    ]);

    try {
        // Add the logged-in user_id to the validated data
        $validatedData['user_id'] = Auth::id(); // Store the user_id of the logged-in user

        // Create the competitor
        Competitor::create($validatedData);

        // Redirect back with success message
        return redirect()->route('competitors.index')->with('success', 'Competitor created successfully!');
    } catch (\Exception $e) {
        // Log the error
        \Log::error('Error creating competitor: ' . $e->getMessage());

        // Redirect back with error message
        return redirect()->back()->with('error', 'Failed to create competitor. Please try again.');
    }
}


    /**
     * Show the form for editing the specified competitor.
     */
    public function edit($id)
    {
        $competitor = Competitor::findOrFail($id);
        // $competitions = Competition::where('user_id', Auth::id())->get();
        // $sideCategories = SideCategory::where('user_id', Auth::id())->get();
        // $readCategories = ReadCategory::where('user_id', Auth::id())->get();
        // $ageCategories = AgeCategory::where('user_id', Auth::id())->get();

        return view('client.competitor.edit',compact('competitor'));
    }

    /**
     * Update the specified competitor in storage.
     */
    public function update(Request $request, $id)
    {
        $competitor = Competitor::findOrFail($id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'full_name' => 'required',
            'id_card_number' => 'required',
            'address' => 'required',
            'island_city' => 'required',
            'school_name' => 'nullable',
            'parent_name' => 'required',
            'phone_number' => 'required',
            'competition_id' => 'required',
            'side_category_id' => 'required',
            'read_category_id' => 'required|integer',
            'age_category_id' => 'required|integer',
            'number_of_questions' => 'required|integer|min:1',
        ]);

        try {
            // Update the competitor
            $competitor->update($validatedData);

            // Redirect back with success message
            return redirect()->route('competitors.index')->with('success', 'Competitor updated successfully!');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error updating competitor: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->with('error', 'Failed to update competitor. Please try again.');
        }
    }

    /**
     * Remove the specified competitor from storage.
     */
    public function destroy($id)
    {
        $competitor = Competitor::findOrFail($id);

        try {
            $competitor->delete();
            return redirect()->route('competitors.index')->with('success', 'Competitor deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting competitor: ' . $e->getMessage());
            return redirect()->route('competitors.index')->with('error', 'Failed to delete competitor. Please try again.');
        }
    }
}
