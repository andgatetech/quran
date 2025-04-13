<?php

namespace App\Http\Controllers\Quiz;

use App\Models\AgeCategory;
use App\Models\Competition;
use App\Models\CompetitionApplication;
use App\Models\ReadCategory;
use App\Models\SideCategory;
use App\Models\Competitor;
use App\Models\CompetitionType;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

class QuizReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $competitionType = CompetitionType::where('name', 'Quiz')->first();
        $status = request()->status ?? 'Participants';
        $competition_id = request()->competition ?? null;
        $age_category = request()->age_category ?? null;
        $side_category = request()->side_category ?? null;
        $read_category = request()->read_category ?? null;
        $applications = CompetitionApplication::where('status',"Pending")
        ->when($competition_id, function($query) use($competition_id){
            $query->where('competition_id',$competition_id);
        })
        ->when($age_category, function($query) use($age_category){
            $query->where('age_category',$age_category);
        })
        ->when($side_category, function($query) use($side_category){
            $query->where('side_category',$side_category);
        })
        ->when($read_category, function($query) use($read_category){
            $query->where('read_category',$read_category);
        })
        ->get();
        $competitions = Competition::
        where('competition_type_id',$competitionType->id)
        ->get();
        
        $side_categories = SideCategory::
        where('competition_type_id',$competitionType->id)
        ->get();
        $read_categories = ReadCategory::
        where('competition_type_id',$competitionType->id)
        ->get();
        $age_categories = AgeCategory::
        where('competition_type_id',$competitionType->id)
        ->get();
        
        return view('client.quiz.reports.index',compact('applications','competitions','status',
            'side_categories','read_categories','age_categories'));
        

    }

    

}
