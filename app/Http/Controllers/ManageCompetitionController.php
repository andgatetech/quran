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

class ManageCompetitionController extends Controller
{

    public function mageyPlan()
    {
        $competition_id = session('competition_id');

        return view('client.manage-competition.list', compact('competition_id'));
    }

    public function howManage()
    {
        $competition_id = session('competition_id');

        return view('client.manage-competition.howManage', compact('competition_id'));
    }


    public function bulkUpload()
    {
        $competition_id = session('competition_id');

        return view('client.manage-competition.bulkUpload', compact('competition_id'));
    }


    public function buyAddOns()
    {
        $competition_id = session('competition_id');

        return view('client.manage-competition.buyAddOns', compact('competition_id'));
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
