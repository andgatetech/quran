<?php

namespace App\Http\Controllers\Quran;


use App\Models\Competition;
use App\Models\CompetitionType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class QuranCompetitionController extends Controller
{
    private $module = "Quran";
    // Show the create competition form
    public function create()
    {
        $moduleName = $this->module;
        return view('client.quran.competition.createcompetition', compact('moduleName')); // Path to your Blade file
    }


    // Edit competition using session ID
    public function edit($competitionId)
    {
        $moduleName = $this->module;
        $competitionId = $competitionId;

        if (!$competitionId) {
            return redirect()->route('quran.competition.list')->with('error', 'No competition selected for editing.');
        }

        $competition = Competition::findOrFail($competitionId);

        return view('client.quran.competition.editcompetition', compact('moduleName','competition'));
    }

    // Update competition





    public function index()
    {
        $moduleName = $this->module;
        $competitions = Competition::where('user_id', Auth::id())->get(); // Fetch competitions for logged-in user
        return view('client.quran.competition.competitionlist', compact('moduleName','competitions'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'main_name' => 'required|string|max:255',
            'sub_name' => 'required|string|max:255',
        ]);
        $competitionType = CompetitionType::where('name', 'Quran')->first();

        Competition::create([
            'competition_type_id' => $competitionType->id,
            'user_id' => Auth::id(), // ID of the logged-in user
            'main_name' => $request->main_name,
            'sub_name' => $request->sub_name,
        ]);

        return redirect()->route('quran.competition.list')->with('success', 'Competition created successfully!');
    }


    public function update($competitionId, Request $request)
    {
        // Retrieve the competition_id from the session
        $competitionId = $competitionId;

        // Check if competition_id exists in the session
        if (!$competitionId) {
            return redirect()->route('quran.competition.list')->with('error', 'No competition selected for updating.');
        }

        // Retrieve the competition and ensure it belongs to the logged-in user
        $competition = Competition::where('id', $competitionId)
            ->where('user_id', Auth::id()) // Ensure the competition belongs to the logged-in user
            ->first();

        // If the competition doesn't exist or doesn't belong to the logged-in user, abort the request
        if (!$competition) {
            return redirect()->route('quran.competition.list')->with('error', 'Unauthorized access or competition not found.');
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

        // Redirect with success message
        return redirect()->route('quran.competition.list')->with('success', 'Competition updated successfully!');
    }

    // Delete a competition
    public function destroy($id)
    {
        $competition = Competition::findOrFail($id);
        $competition->delete();

        return redirect()->route('quran.competition.list')->with('success', 'Competition deleted successfully!');
    }
}























