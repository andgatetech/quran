<?php

namespace App\Http\Controllers;

use App\Models\Host;
use App\Models\Judge;
use App\Models\Quran;
use App\Models\Question;
use App\Models\Competitor;
use App\Models\AgeCategory;
use App\Models\ReadCategory;
use App\Models\SideCategory;
use Illuminate\Http\Request;
use App\Models\QuestionChild;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CallingController extends Controller
{


    public function fetchQuestions()
    {
            $competition_id = session('competition_id');



            $questions = QuestionChild::join('questions', 'questions.id', '=', 'question_child.question_id')
            ->join('competitors', 'competitors.id', '=', 'question_child.competitor_id')
            ->where('competitors.status', 'ongoing')
            ->where('question_child.competition_id', $competition_id)
            ->select(
                '*'
            )
            ->get();
        return response()->json($questions);
    }




// In CompetitorController.php
// public function performed()
// {
//     $competition_id = session('competition_id');

//     $competitors = Competitor::with(['sideCategory', 'readCategory', 'ageCategory'])
//         ->where('competition_id', $competition_id)
//         ->where('status', 'performed')
//         ->get();
//         $sideCategories = SideCategory::where('user_id', Auth::id())->get();
//         $readCategories = ReadCategory::where('user_id', Auth::id())->get();
//         $ageCategories = AgeCategory::where('user_id', Auth::id())->get();
//         return view('calling.performed', compact('competitors', 'competition_id', 'sideCategories', 'readCategories', 'ageCategories'));

// }

public function performed()
{
    $competition_id = session('competition_id');

    // Fetch competitors based on the competition_id and status 'performed'
    $competitors = Competitor::with(['sideCategory', 'readCategory', 'ageCategory'])
    ->where('competition_id', $competition_id)
    ->where(function ($query) {
        $query->where('status', 'performed')
              ->orWhere('status', 'ongoing');
    })
    ->get();
    // Retrieve all categories for filtering
    $sideCategories = SideCategory::where('user_id', Auth::id())->get();
    $readCategories = ReadCategory::where('user_id', Auth::id())->get();
    $ageCategories = AgeCategory::where('user_id', Auth::id())->get();

    // Fetch questions based on competition_id and competitor_id from the question_child table
    $questions = Question::join('question_child as qc', 'qc.question_id', '=', 'questions.id')
        ->where('qc.competition_id', $competition_id)
        ->whereIn('qc.competitor_id', $competitors->pluck('id'))
        ->select('*', 'qc.competitor_id as competitor_id')
        ->get();

    // Pass the data to the view
    return view('calling.performed', compact('competitors', 'competition_id', 'sideCategories', 'readCategories', 'ageCategories', 'questions'));
}

// public function fetchQuestions()
// {
//     $competition_id = session('competition_id');

//     $competitors = Competitor::where('competition_id', $competition_id)
//         ->where(function ($query) {
//             $query->where('status', 'performed')
//                   ->orWhere('status', 'ongoing');
//         })
//         ->pluck('id');
//     $questions = Question::join('question_child as qc', 'qc.question_id', '=', 'questions.id')
//         ->where('qc.competition_id', $competition_id)
//         ->whereIn('qc.competitor_id', $competitors)
//         ->select('*', 'qc.competitor_id as competitor_id')
//         ->get();

//     return response()->json($questions);
// }





































// public function updateStatus($competitor_id)
// {
//     // Find the competitor by ID
//     $competitor = Competitor::find($competitor_id);

//     if ($competitor) {
//         // Check if any competitor in the same competition is already 'ongoing'
//         $existingOngoing = Competitor::where('competition_id', $competitor->competition_id)
//             ->where('status', 'ongoing')
//             ->exists();

//         if ($existingOngoing) {
//             // Redirect back with an alert message
//             return redirect()->back()->with('alert', 'There is already a competitor in progress for this competition.');
//         }

//         // Update the status to 'ongoing'
//         $competitor->status = 'ongoing';
//         $competitor->save();

//         // Redirect to the performed page with the updated competitors
//         return redirect()->route('calling.ready', ['competition_id' => $competitor->competition_id])
//             ->with('success', 'Competitor status updated successfully.');
//     }

//     // Redirect back if the competitor is not found
//     return redirect()->back()->with('error', 'Competitor not found.');
// }








public function updateStatus($competitor_id)
{
    $competition_id = session('competition_id');

    $competitor = Competitor::find($competitor_id);

    if ($competitor) {
        // Check if there are any ongoing competitors for the competition
        $ongoingCompetitors = Competitor::where('competition_id', $competition_id)
                                        ->where('status', 'ongoing')
                                        ->exists();

        if ($ongoingCompetitors) {
            $totalJudgesInCompetition = Judge::where('competition_id', $competition_id)->count();

            $totalJudgesInResult = Competitor::join('results', 'results.competitor_id', '=', 'competitors.id')
                ->where('results.competition_id', $competition_id)
                ->where('competitors.status', 'ongoing')
                ->distinct()
                ->count('results.judge_id');

            if ($totalJudgesInResult == $totalJudgesInCompetition) {
                // Update all competitors with 'ongoing' status to 'performed'
                Competitor::where('competition_id', $competition_id)
                    ->where('status', 'ongoing')
                    ->update(['status' => 'performed']);

                // Update the current competitor's status to 'ongoing'
                $competitor->status = 'ongoing';
                $competitor->save();

                return redirect()->route('calling.ready', ['competition_id' => $competitor->competition_id])
                    ->with('success', 'Competitor status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'The total number of judges who have submitted results does not match the total number of judges for this competition.');
            }
        } else {
            // No ongoing competitors; directly update the current competitor's status
            $competitor->status = 'ongoing';
            $competitor->save();

            return redirect()->route('calling.ready', ['competition_id' => $competitor->competition_id])
                ->with('success', 'Competitor status updated successfully.');
        }
    }

    // Redirect back if the competitor is not found
    return redirect()->back()->with('error', 'Competitor not found.');
}









































    public function revertStatus($competitor_id)
    {
        // Find the competitor by ID
        $competitor = Competitor::find($competitor_id);

        if ($competitor) {
            // Update the status to 'ready'
            $competitor->status = 'ready';
            $competitor->save();
        }

        // Redirect to the performed page with the updated competitors
        return redirect()->route('calling.performed', ['competition_id' => $competitor->competition_id]);
    }












    // Show the login form
    public function login()
    {
        return view('calling.login');
    }






public function loginSubmit(Request $request)
{
    // Validate the input data
    $request->validate([
        'host_id' => 'required|string',
        'password' => 'required|string',
    ]);

    // Attempt to find the host by host_id
    $host = Host::where('host_id', $request->host_id)->first();

    // If host is found, check the password
    if ($host && Hash::check($request->password, $host->password)) {
        // Password matches, so store the competition_id in session
        $competition_id = $host->competition_id;
        session(['host_id' => $request->host_id, 'competition_id' => $competition_id]);

        // Redirect to the ready page
        return redirect()->route('calling.ready');
    } else {
        // If no matching host or invalid password, return to login with an error message
        return redirect()->route('calling.login')->with('error', 'Invalid Host ID or Password.');
    }

}

    // Show the ready page with competition_id


    public function ready()
    {
        $competition_id = session('competition_id');

    // Retrieve competitors with related category names
    $competitors = Competitor::with(['sideCategory', 'readCategory', 'ageCategory'])
        ->where('competition_id', $competition_id)
        ->where('status', 'ready')
        ->get();

        // Retrieve all categories for filtering
        $sideCategories = SideCategory::where('user_id', Auth::id())->get();
        $readCategories = ReadCategory::where('user_id', Auth::id())->get();
        $ageCategories = AgeCategory::where('user_id', Auth::id())->get();

        // Pass the data to the view
        return view('calling.ready', compact('competitors', 'competition_id', 'sideCategories', 'readCategories', 'ageCategories'));
    }


}
