<?php

namespace App\Http\Controllers;

use App\Models\BuyAddon;
use App\Models\Host;
use App\Models\QuestionChild;
use App\Models\SampleFile;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ManageCompetitionController extends Controller
{

    public function mageyPlan()
    {
        $subscriptionPlans = SubscriptionPlan::get();

        return view('client.manage-competition.subscription', compact('subscriptionPlans'));
    }

    public function howManage()
    {
        $howFiles = SampleFile::where('file_type', 'how_to')->get();

        return view('client.manage-competition.howManage', compact('howFiles'));
    }


    public function bulkUpload()
    {
        $bulkUploadSampleFiles = SampleFile::where('file_type', 'bulk_upload')->get();

        return view('client.manage-competition.bulkUpload', compact('bulkUploadSampleFiles'));
    }


    public function buyAddOns()
    {
        $addOns = BuyAddon::get();

        return view('client.manage-competition.buyAddOns', compact('addOns'));
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
