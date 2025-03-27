<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CompetitionController extends Controller
{
    // Show the create competition form
    public function create()
    {
        return view('client.competition.createcompetition'); // Path to your Blade file
    }

    // Store the competition data

    // Show edit form for a competition
    public function setSession(Request $request)
    {
        $request->validate([
            'competition_id' => 'required|exists:competitions,id',
        ]);

        // Store the competition ID in the session
        Session::put('competition_id', $request->competition_id);

        return redirect()->route('competition.edit');
    }

    // Edit competition using session ID
    public function edit()
    {
        $competitionId = Session::get('competition_id');

        if (!$competitionId) {
            return redirect()->route('competition.list')->with('error', 'No competition selected for editing.');
        }

        $competition = Competition::findOrFail($competitionId);

        return view('client.competition.editcompetition', compact('competition'));
    }

    // Update competition



    // Delete a competition
    public function destroy($id)
    {
        $competition = Competition::findOrFail($id);
        $competition->delete();

        return redirect()->route('competition.list')->with('success', 'Competition deleted successfully!');
    }

    public function index()
    {
        $competitions = Competition::where('user_id', Auth::id())->get(); // Fetch competitions for logged-in user
        return view('client.competition.competitionlist', compact('competitions'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'main_name' => 'required|string|max:255',
            'sub_name' => 'required|string|max:255',
        ]);

        Competition::create([
            'user_id' => Auth::id(), // ID of the logged-in user
            'main_name' => $request->main_name,
            'sub_name' => $request->sub_name,
        ]);

        return redirect()->route('competition.list')->with('success', 'Competition created successfully!');
    }


    public function update(Request $request)
{
    // Retrieve the competition_id from the session
    $competitionId = Session::get('competition_id');

    // Check if competition_id exists in the session
    if (!$competitionId) {
        return redirect()->route('competition.list')->with('error', 'No competition selected for updating.');
    }

    // Retrieve the competition and ensure it belongs to the logged-in user
    $competition = Competition::where('id', $competitionId)
        ->where('user_id', Auth::id()) // Ensure the competition belongs to the logged-in user
        ->first();

    // If the competition doesn't exist or doesn't belong to the logged-in user, abort the request
    if (!$competition) {
        return redirect()->route('competition.list')->with('error', 'Unauthorized access or competition not found.');
    }

    // Validate the form input
    $request->validate([
        'main_name' => 'required|string|max:255',
        'sub_name' => 'required|string|max:255',
    ]);

    // Update the competition
    $competition->update([
        'main_name' => $request->main_name,
        'sub_name' => $request->sub_name,
    ]);

    // Clear the session after updating
    Session::forget('competition_id');

    // Redirect with success message
    return redirect()->route('competition.list')->with('success', 'Competition updated successfully!');
}
}























