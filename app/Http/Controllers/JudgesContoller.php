<?php

namespace App\Http\Controllers;

use App\Models\Host;
use App\Models\Judge;
use App\Models\Quran;
use App\Models\Result;
use App\Models\Competitor;
use Illuminate\Http\Request;
use App\Models\PointCategory;
use App\Models\QuestionChild;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class JudgesContoller extends Controller
{




    public function index()
    {
        $competition_id = session('competition_id');
        // dd($competition_id);

        $judge_id = session('judge_id');

        // Fetch competitors
        $competitors = Competitor::join('competitions', 'competitions.id', '=', 'competitors.competition_id')
            ->where('competitors.status', 'ongoing')
            ->select(
                '*',
                'competitions.main_name as competition_name',
                'competitions.sub_name as competition_sub_name',
                'competitors.id as competitor_id'
            )
            ->get();

        // Fetch the judge
        $judge = Judge::where('id', $judge_id)->firstOrFail();

        // Decode point category IDs
        $pointCategoryIds = json_decode($judge->point_category_id, true);
        $pointCategories = PointCategory::whereIn('id', $pointCategoryIds)->get();

        // Check if results already exist for each competitor
        foreach ($competitors as $competitor) {
            $existingResult = Result::where('competitor_id', $competitor->competitor_id)
                ->where('competition_id', $competitor->competition_id)
                ->where('judge_id', $judge_id)
                ->first();

            $competitor->already_allotted = $existingResult ? true : false;
            $competitor->existing_points = $existingResult ? $existingResult->points : null; // Assuming `points` column exists
        }













        $questions = QuestionChild::join('questions', 'questions.id', '=', 'question_child.question_id')
        ->join('competitors', 'competitors.id', '=', 'question_child.competitor_id')
        ->where('competitors.status', 'ongoing')
        ->where('questions.competition_id', $competition_id)
        ->select(
            '*'
        )
        ->get();



        return view('judges.index', compact('competitors', 'judge', 'pointCategories', 'competition_id', 'judge_id','questions'));


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

        return response()->json($questions);
    }





















    public function login()
    {
        return view('judges.login');
    }

    public function judgelogin()
    {
        return view('judges.judgelogin');
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
        return redirect()->route('judges.judgelogin')->with('success', 'Login Successfull');
    } else {
        // If no matching host or invalid password, return to login with an error message
        return redirect()->route('judges.login')->with('error', 'Invalid Host ID or Password.');
    }

}








public function judgeloginsubmit(Request $request)
{
    // Validate the input data
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $competition_id = session('competition_id'); // Get the competition ID from the session

    // Attempt to find the judge by email
    $judge = Judge::where('email', $request->email)->first();

    // Check if the email exists
    if (!$judge) {
        return redirect()->back()->with('error', 'Invalid email address.');
    }

    // Check if the password matches
    if (!Hash::check($request->password, $judge->password)) {
        return redirect()->back()->with('error', 'Invalid password.');
    }

    // Check if the competition ID matches
    if ($judge->competition_id != $competition_id) {
        return redirect()->back()->with('error', 'Credentials do not match with your competition.');
    }

    // If all checks pass, store the judge ID in the session
    session(['judge_id' => $judge->id]);

    // Redirect to the dashboard or success page
    return redirect()->route('judges2.index')->with('success', 'Login Successful');
}

























































}
