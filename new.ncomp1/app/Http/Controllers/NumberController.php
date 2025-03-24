<?php

namespace App\Http\Controllers;

use App\Models\Host;
use App\Models\Sponsor;
use App\Models\Question;
use App\Models\Competitor;
use Illuminate\Http\Request;
use App\Models\QuestionChild;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class NumberController extends Controller
{

    public function login()
    {
        return view('number.login');
    }






    public function index()
    {
        $competition_id = session('competition_id');

        // Get the first competitor_id where competition_id is ongoing
        $competitor_id = Competitor::where('competition_id', $competition_id)
            ->where('status', 'ongoing')
            ->select('id as competitor_id')
            ->first();


            if (!$competitor_id) {
                return view('number.index', compact( 'competitor_id'))->with('error', 'No ongoing competitor found');
        }

        // Use the competitor_id to fetch related questions
        $questions = Question::join('age_categories', 'questions.age_category_id', '=', 'age_categories.id')
        ->join('side_categories', 'questions.side_category_id', '=', 'side_categories.id')
        ->join('read_categories', 'questions.read_category_id', '=', 'read_categories.id')
        ->join('competitions', 'questions.competition_id', '=', 'competitions.id')
        ->join('competitors', function ($join) {
            $join->on('questions.side_category_id', '=', 'competitors.side_category_id')
                ->on('questions.age_category_id', '=', 'competitors.age_category_id')
                ->on('questions.read_category_id', '=', 'competitors.read_category_id');
        })
        ->where('questions.competition_id', '=', $competition_id)
        ->where('competitors.id', '=', $competitor_id->competitor_id)
        ->whereNotIn('questions.id', function ($query) use ($competition_id, $competitor_id) {
            $query->select('question_id')
                ->from('question_child')
                ->where('competition_id', $competition_id)
                ->where('competitor_id', $competitor_id->competitor_id);
        })
        ->select('*', 'competitors.id as competitor_id', 'questions.id as question_id')
        ->get();


        // Return to the view
        return view('number.index', compact('questions', 'competition_id','competitor_id'));
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
            return redirect()->route('number.index');
        } else {
            // If no matching host or invalid password, return to login with an error message
            return redirect()->route('number.login')->with('error', 'Invalid Host ID or Password.');
        }}




    public function store(Request $request)
    {
        // dd($request->question_id);
        // Count the number of questions already done for this competitor in the competition
        $number_of_questions_done = QuestionChild::where('competitor_id', $request->competitor_id)
            ->where('competition_id', $request->competition_id)
            ->count();
        $competitor = Competitor::where('id', $request->competitor_id)->first();
        $number_of_questions = $competitor->number_of_questions;
        if ($number_of_questions_done >= $number_of_questions) {
            return redirect()->back()->with('error', 'The competitor has already reached the maximum number of questions allowed.');
        }

        foreach ($request->question_id as $questionId) {
            QuestionChild::create([
                'question_id' => $questionId,
                'competitor_id' => $request->competitor_id,
                'competition_id' => $request->competition_id,
                'status' => 'active', // Example status, adjust as needed
            ]);
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Questions successfully submitted!');
    }











}
