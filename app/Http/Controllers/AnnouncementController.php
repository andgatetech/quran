<?php

namespace App\Http\Controllers;

use App\Models\Host;
use App\Models\Sponsor;
use App\Models\Question;
use App\Models\Competitor;
use App\Models\AgeCategory;
use App\Jobs\DeactivateBell;
use App\Models\ReadCategory;
use App\Models\SideCategory;
use Illuminate\Http\Request;
use App\Models\QuestionChild;
use App\Models\BellNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AnnouncementController extends Controller
{
    public function login()
    {
        return view('announcement.login');
    }
    public function winners()
    {
        $competition_id = session('competition_id');
        $sponsors = Sponsor::where('competition_id', $competition_id)
            ->get();
$winners = DB::table('rankings as r')
            ->join('competitions as ctn', 'r.competition_id', '=', 'ctn.id')
            ->join('competitors as ctr', 'r.competitor_id', '=', 'ctr.id')
            ->join('age_categories as ac', 'ac.id', '=', 'ctr.age_category_id')
            ->join('read_categories as rc', 'rc.id', '=', 'ctr.read_category_id')
            ->join('side_categories as sc', 'sc.id', '=', 'ctr.side_category_id')
            ->select(
                '*',
                'ctn.main_name as competition_name',
                'ctr.full_name as competitor_name',
                'ac.name as age_category_name',
                'rc.name as read_category_name',
                'sc.name as side_category_name'
            )
            ->where('r.status', 'announced')
            ->where('r.competition_id', $competition_id)
            ->orderBy('r.rank', 'asc') // Order by rank for proper display
            ->get();

            $sideCategories = SideCategory::where('user_id', Auth::id())->get();
            $readCategories = ReadCategory::where('user_id', Auth::id())->get();
            $ageCategories = AgeCategory::where('user_id', Auth::id())->get();


        return view('announcement.winners', compact('winners', 'sponsors', 'sideCategories', 'readCategories', 'ageCategories'));
    }

    public function getWinnersAjax(Request $request)
    {
        $competition_id = session('competition_id');
        $sideCategoryId = $request->input('side_category_id');
        $readCategoryId = $request->input('read_category_id');
        $ageCategoryId = $request->input('age_category_id');

        $query = DB::table('rankings as r')
            ->join('competitions as ctn', 'r.competition_id', '=', 'ctn.id')
            ->join('competitors as ctr', 'r.competitor_id', '=', 'ctr.id')
            ->join('age_categories as ac', 'ac.id', '=', 'ctr.age_category_id')
            ->join('read_categories as rc', 'rc.id', '=', 'ctr.read_category_id')
            ->join('side_categories as sc', 'sc.id', '=', 'ctr.side_category_id')
            ->select(
                '*',
                'ctn.main_name as competition_name',
                'ctr.full_name as competitor_name',
                'ac.name as age_category_name',
                'rc.name as read_category_name',
                'sc.name as side_category_name'
            )
            ->where('r.status', 'announced')
            ->where('r.competition_id', $competition_id);

        // Apply filters
        if ($sideCategoryId) {
            $query->where('ctr.side_category_id', $sideCategoryId);
        }
        if ($readCategoryId) {
            $query->where('ctr.read_category_id', $readCategoryId);
        }
        if ($ageCategoryId) {
            $query->where('ctr.age_category_id', $ageCategoryId);
        }

        $winners = $query->orderBy('r.rank', 'asc')->get();

        return response()->json($winners);
    }



    // public function index()
    // {
    //     $competition_id = session('competition_id');

    //     // Fetch sponsors and competitors
    //     $sponsors = Sponsor::where('user_id', Auth::id())->get(); // Assuming you have a Sponsor model
    //     $competitors = Competitor::with([
    //             'sideCategory',
    //             'readCategory',
    //             'ageCategory'
    //         ])
    //         ->join('competitions', 'competitors.competition_id', '=', 'competitions.id')
    //         ->where('competitors.status', 'ongoing')
    //         ->where('competitors.competition_id', $competition_id) // Add this condition
    //         ->select(
    //             'competitors.*',
    //             'competitions.main_name as competition_main_name',
    //             'competitions.sub_name as competition_sub_name'
    //         )
    //         ->get();

    //         $questions = Question::join('question_child as qc', 'qc.question_id', '=', 'questions.id')
    //         ->where('qc.competition_id', $competition_id)
    //         ->whereIn('qc.competitor_id', $competitors->pluck('id'))
    //         ->select('questions.id', 'questions.question_name', 'questions.hardness')
    //         ->get();


    //     // Pass both to the view
    //     return view('announcement.index', compact('competitors', 'sponsors','questions','competition_id'));
    // }




    public function index()
    {
        $competition_id = session('competition_id');

        // Fetch sponsors and competitors
        $sponsors = Sponsor::where('competition_id', $competition_id)
            ->get();
        $competitors = Competitor::with(['sideCategory', 'readCategory', 'ageCategory'])
            ->join('competitions', 'competitors.competition_id', '=', 'competitions.id')
            ->where('competitors.status', 'ongoing')
            ->where('competitors.competition_id', $competition_id)
            ->select(
                'competitors.*',
                'competitions.main_name as competition_main_name',
                'competitions.sub_name as competition_sub_name'
            )
            ->get();

        // Fetch questions related to the competition
        $questions = Question::join('question_child as qc', 'qc.question_id', '=', 'questions.id')
            ->where('qc.competition_id', $competition_id)
            ->whereIn('qc.competitor_id', $competitors->pluck('id'))
            ->select('questions.id as question_id', 'questions.question_name', 'questions.hardness')
            ->get();

        return view('announcement.index', compact('competitors', 'sponsors', 'questions', 'competition_id'));
    }



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

        // Return the questions as a JSON response
        return response()->json($questions);
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
            return redirect()->route('announcement.index');
        } else {
            // If no matching host or invalid password, return to login with an error message
            return redirect()->route('calling.login')->with('error', 'Invalid Host ID or Password.');
        }
    }
}
