<?php

namespace App\Http\Controllers\Quiz;

use App\Models\AgeCategory;
use App\Models\Competition;
use App\Models\CompetitionApplication;
use App\Models\ReadCategory;
use App\Models\SideCategory;
use App\Models\Competitor;
use App\Models\CompetitionType;
use App\Models\CompetatorQuizAnswer;
use Illuminate\Routing\Controller;


use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        
        $competitionType = CompetitionType::where('name', 'Quiz')->first();
        $status = request()->status ?? 'Pending';
        $competition_id = request()->competition ?? null;
        $answers= CompetatorQuizAnswer::
        where('answer_status',$status)
        ->get();


        $competitions = Competition::
        where('competition_type_id',$competitionType->id)
        ->get();
       

        return view('client.quiz.answer.index',compact('answers','competitions','status',));

    }
    public function updateStatus(Request $request)
    {
        
       
        
        $application = CompetatorQuizAnswer::findOrFail($request->competator_answer_id);
        // Update the application status and remarks
        $application->answer_status = $request->status;
        $application->save();
    
        return redirect()->route('quiz.competator.answer.list', ['status' => $request->status])
            ->with('success', 'Answer status updated successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
