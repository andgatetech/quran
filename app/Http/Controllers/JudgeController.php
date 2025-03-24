<?php

namespace App\Http\Controllers;

use App\Models\Judge;
// use App\Models\Competition;
use App\Models\Competition;
use Illuminate\Http\Request;
use App\Models\PointCategory;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class JudgeController extends Controller
{
    /**
     * Display a listing of the judges.
     */
    public function index()
    {
        // Fetch judges for the logged-in user
        $judges = Judge::where('user_id', Auth::id())->get(); // Filter by user_id

        return view('client.judge.list', compact('judges'));
    }

    /**
     * Show the form for creating a new judge.
     */
    public function create()
    {
        // Fetch point categories for the logged-in user
        $pointCategories = PointCategory::where('user_id', Auth::id())->get();

        // Fetch all competitions and pass them to the view
        $competitions = Competition::where('user_id', Auth::id())->get();

        return view('client.judge.create', compact('competitions', 'pointCategories'));
    }


    /**
     * Store a newly created judge in storage.
     */
    public function store(Request $request)
    {
        try {
            // Hash the password before storing
            $request->merge(['password' => Hash::make($request->password)]);

            // Convert the point_category_id to an array (if it's not already)
            $pointCategoryIds = $request->input('point_category_id', []);

            // Create the judge
            $judge = Judge::create([
                'full_name' => $request->input('full_name'),
                'id_card_number' => $request->input('id_card_number'),
                'address' => $request->input('address'),
                'island_city' => $request->input('island_city'),
                'work_office' => $request->input('work_office'),
                'phone_number' => $request->input('phone_number'),
                'competition_id' => $request->input('competition_id'),
                'point_category_id' => json_encode($pointCategoryIds),  // Store as JSON
                'bell_option' => $request->input('bell_option'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);

            // Redirect to judge list with success message
            return redirect()->route('judges.index')->with('success', 'Judge created successfully!');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error creating judge: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->with('error', 'Failed to create judge. Please try again.');
        }
    }
    public function update(Request $request, $id)
    {
        try {
            // Find the Judge record
            $judge = Judge::findOrFail($id);

            // Validate incoming request
            $validatedData = $request->validate([
                'full_name' => 'required|string|max:255',
                'id_card_number' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'island_city' => 'required|string|max:255',
                'work_office' => 'required|string|max:255',
                'phone_number' => 'required|string|max:20',
                'competition_id' => 'required|integer',
                'point_category_id' => 'nullable|array', // Optional array input
                'bell_option' => 'required|in:Enable,Disable', // Restrict to specific values
                'email' => 'required|email|max:255|unique:judges,email,' . $judge->id, // Unique email except for the current record
                'password' => 'nullable|min:6', // Optional, minimum length if provided
            ]);

            // Handle password update only if provided
            if ($request->filled('password')) {
                $validatedData['password'] = Hash::make($request->input('password'));
            } else {
                unset($validatedData['password']); // Prevent password overwrite
            }

            // Handle point categories: convert to JSON or set to null
            $validatedData['point_category_id'] = $request->filled('point_category_id')
                ? json_encode($request->input('point_category_id'))
                : null;

            // Update the Judge record with validated data
            $judge->update($validatedData);

            // Redirect to index page with a success message
            return redirect()->route('judges.index')->with('success', 'Judge updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Error updating judge: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Failed to update Judge. Please try again.');
        }
    }



    /**
     * Remove the specified judge from storage.
     */
    public function destroy($id)
    {
        try {
            $judge = Judge::findOrFail($id);

            // Delete the judge
            $judge->delete();

            // Redirect to judge list with success message
            return redirect()->route('judges.index')->with('success', 'Judge deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting judge: ' . $e->getMessage());
            return redirect()->route('judges.index')->with('error', 'Failed to delete judge. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified judge.
     */
    public function edit($id)
    {

        $pointCategories = PointCategory::where('user_id', Auth::id())->get();

        // Fetch all competitions and pass them to the view
        $competitions = Competition::where('user_id', Auth::id())->get();
        $judge = Judge::findOrFail($id);
        return view('client.judge.edit', compact('judge','pointCategories','competitions'));
    }



}
