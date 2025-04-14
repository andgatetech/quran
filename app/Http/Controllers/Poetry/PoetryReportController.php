<?php

namespace App\Http\Controllers\Poetry;

use App\Models\AgeCategory;
use App\Models\Competition;
use App\Models\CompetitionApplication;
use App\Models\ReadCategory;
use App\Models\SideCategory;
use App\Models\Report;
use App\Models\Competitor;
use App\Models\CompetitionType;
use App\Http\Controllers\Controller;


use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PoetryReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $module = "Poetry";
    private $competitionType;
    public function __construct(){
        // find competition type;
        $this->competitionType = CompetitionType::where('name', 'Poetry')->first();
    }

    public function index()
    {
        $competitionType = CompetitionType::where('name', 'Poetry')->first();
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
        $competitions = Competition::where('status','On-Going')
        ->where('competition_type_id',$competitionType->id)
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
        $reports = Report::where('report_type', $status)->get();
        if($status=="Participants"){
            return view('client.poetry.reports.index',compact('reports','applications','competitions','status',
            'side_categories','read_categories','age_categories'));
        }else if($status=="Sponsers"){
            return view('client.poetry.reports.sponsers',compact('reports','applications','competitions','status',
            'side_categories','read_categories','age_categories'));
        }else{
             return view('client.poetry.reports.winners',compact('reports','applications','competitions','status',
            'side_categories','read_categories','age_categories'));
        }

    }

    public function generateParticipantReport(Request $request)
    {
        $status = $request->status;
        $competitionRequest = $request->competition;
        $ageCategoryRequest = $request->age_category;
        $recitationMethodRequest = $request->side_category;
        $recitationPieceRequest = $request->read_category;

        $competition = Competition::where([
            ['user_id', '=', Auth::guard('client')->id()],
            ['competition_type_id', '=', $this->competitionType->id]
        ])->get();
        $ageCategory = AgeCategory::where([
            ['user_id', '=', Auth::guard('client')->id()],
            ['competition_type_id', '=', $this->competitionType->id]
        ])->get();
        $recitationPiece = SideCategory::where([
            ['user_id', '=', Auth::guard('client')->id()],
            ['competition_type_id', '=', $this->competitionType->id]
        ])->get();
        $recitationMethod = ReadCategory::where([
            ['user_id', '=', Auth::guard('client')->id()],
            ['competition_type_id', '=', $this->competitionType->id]
        ])->get();


        // Generate the PDF
        $pdf = Pdf::loadView('client.poetry.reports.reportParticipant', compact('competition', 'ageCategory', 'recitationPiece', 'recitationMethod'));

        // Create reports folder if it doesn't exist
        $directory = public_path('reports/quran/participants/');
        if (!file_exists($directory)) {
            mkdir($directory, 0775, true);
        }

        $filename = 'participant_report_' . Str::uuid() . '.pdf';
        $fullPath = $directory . '/' . $filename;

        // Save PDF
        $pdf->save($fullPath);

        // // Store into reports table
        Report::create([
            'report_type' => $status,
            'competition_id' => $competitionRequest,
            'age_category_id' => $ageCategoryRequest,
            'side_category_id' => $recitationPieceRequest, 
            'read_category_id' => $recitationMethodRequest,
            'anouncement_date' => '',
            'date_of_close' => '',
            'status' => 1,
            'path' => 'reports/quran/participants/'.$filename,
            'date_of_report' => now(),
            'user_id' => Auth::guard('client')->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('poetry.report',['status' => $request->status])->with('success', 'Participant report generated successfully!');

    }
   
    public function generateSponsorReport(Request $request){
        // dd($request);
        $status = $request->status;
        $competitionRequest = $request->competition;
        $ageCategoryRequest = $request->age_category;
        $recitationMethodRequest = $request->side_category;
        $recitationPieceRequest = $request->read_category;

        $competition = Competition::where([
            ['user_id', '=', Auth::guard('client')->id()],
            ['competition_type_id', '=', $this->competitionType->id]
        ])->get();
        $ageCategory = AgeCategory::where([
            ['user_id', '=', Auth::guard('client')->id()],
            ['competition_type_id', '=', $this->competitionType->id]
        ])->get();
        $recitationPiece = SideCategory::where([
            ['user_id', '=', Auth::guard('client')->id()],
            ['competition_type_id', '=', $this->competitionType->id]
        ])->get();
        $recitationMethod = ReadCategory::where([
            ['user_id', '=', Auth::guard('client')->id()],
            ['competition_type_id', '=', $this->competitionType->id]
        ])->get();


        // Generate the PDF
        $pdf = Pdf::loadView('client.poetry.reports', compact('competition', 'ageCategory', 'recitationPiece', 'recitationMethod'));

        // Create reports folder if it doesn't exist
        $directory = public_path('reports/quran/sponsors/');
        if (!file_exists($directory)) {
            mkdir($directory, 0775, true);
        }

        $filename = 'sponsor_report_' . Str::uuid() . '.pdf';
        $fullPath = $directory . '/' . $filename;

        // Save PDF
        $pdf->save($fullPath);

        // // Store into reports table
        Report::create([
            'report_type' => $status,
            'competition_id' => $competitionRequest,
            'age_category_id' => $ageCategoryRequest,
            'side_category_id' => $recitationPieceRequest, 
            'read_category_id' => $recitationMethodRequest,
            'anouncement_date' => '',
            'date_of_close' => '',
            'status' => 1,
            'path' => 'reports/quran/sponsors/'.$filename,
            'date_of_report' => now(),
            'user_id' => Auth::guard('client')->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('poetry.report',['status' => $request->status])->with('success', 'Sponsor report generated successfully!');

    }
    public function generateWinnerReport(Request $request){
          // dd($request);
          $status = $request->status;
          $competitionRequest = $request->competition;
          $ageCategoryRequest = $request->age_category;
          $recitationMethodRequest = $request->side_category;
          $recitationPieceRequest = $request->read_category;
  
          $competition = Competition::where([
              ['user_id', '=', Auth::guard('client')->id()],
              ['competition_type_id', '=', $this->competitionType->id]
          ])->get();
          $ageCategory = AgeCategory::where([
              ['user_id', '=', Auth::guard('client')->id()],
              ['competition_type_id', '=', $this->competitionType->id]
          ])->get();
          $recitationPiece = SideCategory::where([
              ['user_id', '=', Auth::guard('client')->id()],
              ['competition_type_id', '=', $this->competitionType->id]
          ])->get();
          $recitationMethod = ReadCategory::where([
              ['user_id', '=', Auth::guard('client')->id()],
              ['competition_type_id', '=', $this->competitionType->id]
          ])->get();
  
  
          // Generate the PDF
          $pdf = Pdf::loadView('client.poetry.reports', compact('competition', 'ageCategory', 'recitationPiece', 'recitationMethod'));
  
          // Create reports folder if it doesn't exist
          $directory = public_path('reports/quran/winners/');
          if (!file_exists($directory)) {
              mkdir($directory, 0775, true);
          }
  
          $filename = 'winner_report_' . Str::uuid() . '.pdf';
          $fullPath = $directory . '/' . $filename;
  
          // Save PDF
          $pdf->save($fullPath);
  
          // // Store into reports table
          Report::create([
              'report_type' => $status,
              'competition_id' => $competitionRequest,
              'age_category_id' => $ageCategoryRequest,
              'side_category_id' => $recitationPieceRequest, 
              'read_category_id' => $recitationMethodRequest,
              'anouncement_date' => '',
              'date_of_close' => '',
              'status' => 1,
              'path' => 'reports/quran/winners/'.$filename,
              'date_of_report' => now(),
              'user_id' => Auth::guard('client')->id(),
              'created_at' => now(),
              'updated_at' => now(),
          ]);
  
          return redirect()->route('poetry.report',['status' => $request->status])->with('success', 'Winners report generated successfully!');
    } 

}
