<?php

namespace App\Http\Controllers;

use App\Models\Host;
use App\Models\Ranking;
use App\Models\Competitor;
use App\Models\AgeCategory;
use App\Models\Competition;
use App\Models\ReadCategory;
use App\Models\SideCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RankingController extends Controller
{


    public function login()
    {
        return view('winning-announcement.login');
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
            return redirect()->route('winning.index');
        } else {
            // If no matching host or invalid password, return to login with an error message
            return redirect()->route('winning.login')->with('error', 'Invalid Host ID or Password.');
        }}


    public function announce($competitorId)
    {
        // Find the competitor
        $competitor = Competitor::find($competitorId);

        if (!$competitor) {
            return back()->with('error', 'Competitor not found.');
        }

        // Find the ranking related to this competitor
        $ranking = Ranking::where('competitor_id', $competitor->id)
                          ->where('competition_id', session('competition_id')) // Assuming you have competition_id in session
                          ->first();

        if ($ranking) {
            // Update the status to 'announced'
            $ranking->status = 'announced';
            $ranking->save();
        }

        return back()->with('success', 'Competitor announced successfully.');
    }

    // Recheck a competitor by deleting the related ranking record
    public function recheck($competitorId)
    {
        // Find the competitor
        $competitor = Competitor::find($competitorId);

        if (!$competitor) {
            return back()->with('error', 'Competitor not found.');
        }

        // Find and delete the ranking related to this competitor
        $ranking = Ranking::where('competitor_id', $competitor->id)
                          ->where('competition_id', session('competition_id')) // Assuming you have competition_id in session
                          ->first();

        if ($ranking) {
            // Delete the ranking record
            $ranking->delete();
        }

        return back()->with('success', 'Competitor record deleted successfully.');
    }























































    public function index()
    {
        $competition_id = session('competition_id');

        $competition = Competition::where('id',$competition_id)->first();
       $competitors = Competitor::with([
    'sideCategory',
    'readCategory',
    'ageCategory',
    'results' => function ($query) use ($competition_id) {
        $query->where('competition_id', $competition_id)
              ->with('pointCategory'); // Eager load pointCategory for results
    }
])
->join('rankings', 'rankings.competitor_id', '=', 'competitors.id')
->where('rankings.competition_id', $competition_id)
->where('rankings.status', 'pending')
->select('competitors.*', 'rankings.status as ranking_status') // Add ranking status to the result
->get();
return view('winning-announcement.index', compact('competitors','competition'));

    }








    // public function fetchWinners()
    // {
    //     $competition_id = session('competition_id');

    //     $competitors = Competitor::with([
    //         'sideCategory',
    //         'readCategory',
    //         'ageCategory',
    //         'results' => function ($query) use ($competition_id) {
    //             $query->where('competition_id', $competition_id)
    //                   ->with('pointCategory'); // Eager load pointCategory for results
    //         }
    //     ])
    //     ->join('rankings', 'rankings.competitor_id', '=', 'competitors.id')
    //     ->where('rankings.competition_id', $competition_id)
    //     ->where('rankings.status', 'pending')
    //     ->select('competitors.*', 'rankings.status as ranking_status') // Add ranking status to the result
    //     ->get();

    //     return response()->json($competitors);
    // }


    public function fetchWinners()
{
    $competition_id = session('competition_id');

    // Load the required related data
    $competitors = Competitor::with([
        'sideCategory',  // sideCategory has a 'name' field
        'readCategory',  // readCategory has a 'name' field
        'ageCategory',   // ageCategory has a 'name' field
        'competition',   // competition has a 'name' field
        'results.pointCategory' // Point categories should be accessed here
    ])
    ->join('rankings', 'rankings.competitor_id', '=', 'competitors.id')
    ->where('rankings.competition_id', $competition_id)
    ->where('rankings.status', 'pending')
    ->select('competitors.*', 'rankings.status as ranking_status') // Add ranking status to the result
    ->get();

    // Add the relevant names directly to each competitor object
    $competitors->each(function ($competitor) {
        $competitor->age_category_name = $competitor->ageCategory ? $competitor->ageCategory->name : 'N/A';
        $competitor->side_category_name = $competitor->sideCategory ? $competitor->sideCategory->name : 'N/A';
        $competitor->read_category_name = $competitor->readCategory ? $competitor->readCategory->name : 'N/A';
        $competitor->competition_name = $competitor->Competition ? $competitor->competition->main_name : 'N/A';

        // Add point categories name for each result
        $competitor->results->each(function ($result) {
            $result->point_category_name = $result->pointCategory ? $result->pointCategory->name : 'N/A';
        });
    });

    return response()->json($competitors);
}

















































    public function create(Request $request, $competitor_id)
    {
        $competition_id = session('competition_id');
        $rank = $request->input('rank');

        // Check if there is any 'pending' ranking for this competition
        $pendingRanking = Ranking::where('competition_id', $competition_id)
            ->where('status', 'pending')
            ->exists();

        if ($pendingRanking) {
            return back()->with('error', 'Cannot store a new ranking. A pending ranking already exists for this competition.');
        }

        // Check if a ranking already exists for this competitor
        $existingRanking = Ranking::where('competitor_id', $competitor_id)
            ->where('competition_id', $competition_id)
            ->first();

        if ($existingRanking) {
            return back()->with('error', 'Ranking already exists for this competitor.');
        }

        // Store the new ranking
        Ranking::create([
            'competitor_id' => $competitor_id,
            'competition_id' => $competition_id,
            'rank' => $rank,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Ranking saved successfully.');
    }







    // public function announceWinners()
    // {
    //     // Retrieve the competition_id from the session
    //     $competition_id = session('competition_id');

    //     // Retrieve competitors with related categories and their results
    //     $competitors = Competitor::with(['sideCategory', 'readCategory', 'ageCategory', 'results' => function($query) use ($competition_id) {
    //         $query->where('competition_id', $competition_id);
    //     }])
    //     ->where('competition_id', $competition_id)
    //     ->where('status', 'performed')
    //     ->get();

    //     // Retrieve all categories for filtering (if needed)
    //     $sideCategories = SideCategory::where('user_id', Auth::id())->get();
    //     $readCategories = ReadCategory::where('user_id', Auth::id())->get();
    //     $ageCategories = AgeCategory::where('user_id', Auth::id())->get();

    //     // Pass the data to the view
    //     return view('client.host.announce', compact('competitors', 'competition_id', 'sideCategories', 'readCategories', 'ageCategories'));
    // }





    public function announceWinners()
{
    // Retrieve the competition_id from the session
    $competition_id = session('competition_id');

    // dd($competition_id);
    // Retrieve competitors with related categories and their results
   $competitors = Competitor::with(['sideCategory', 'readCategory', 'ageCategory', 'results' ])
    ->where('status', 'performed')
    ->where('user_id', Auth::id())
    ->get();
    foreach ($competitors as $competitor) {
        $competitor->total_gained_points = $competitor->results->sum('gained_points');
    }
    $sortedCompetitors = $competitors->sortByDesc('total_gained_points')->values();

    // Calculate positions
    $position = 1;
    $lastPoints = null;
    foreach ($sortedCompetitors as $index => $competitor) {
        if ($lastPoints !== null && $competitor->total_gained_points < $lastPoints) {
            $position = $index + 1; // Increment position only if points differ
        }
        $competitor->position = $position;
        $lastPoints = $competitor->total_gained_points;
    }

    // Retrieve all categories for filtering (if needed)
    $sideCategories = SideCategory::where('user_id', Auth::id())->get();
    $readCategories = ReadCategory::where('user_id', Auth::id())->get();
    $ageCategories = AgeCategory::where('user_id', Auth::id())->get();

    // Pass the data to the view
    return view('client.host.announce', compact('sortedCompetitors', 'competition_id', 'sideCategories', 'readCategories', 'ageCategories'));
}







}
