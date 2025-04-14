<?php

namespace App\Http\Controllers;

use App\Models\AgeCategory;
use App\Models\Competition;
use App\Models\CompetitionApplication;
use App\Models\CompetitionType;
use App\Models\ReadCategory;
use App\Models\Report;
use App\Models\SideCategory;
use App\Models\Competitor;


use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class QuranReportController extends Controller
{
    private $module = "Quran";
    private $competitionType;

    public function __construct(){
        // find competition type;
        $this->competitionType = CompetitionType::where('name', 'Quran')->first();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        $competitions = Competition::where('status','On-Going')->get();
        $side_categories = SideCategory::get();
        $read_categories = ReadCategory::get();
        $age_categories = AgeCategory::get();

        
        $reports = Report::where('report_type', $status)->get();

        if($status=="Participants"){
            return view('client.quran-reports.index',compact('applications','competitions','status',
            'side_categories','read_categories','age_categories', 'reports'));
        }else if($status=="Sponsers"){
            return view('client.quran-reports.sponsers',compact('applications','competitions','status',
            'side_categories','read_categories','age_categories', 'reports'));
        }else{
            return view('client.quran-reports.winners',compact('applications','competitions','status',
            'side_categories','read_categories','age_categories', 'reports'));
        }

    }
    public function updateStatus(Request $request)
    {
        $request->validate([
            'application_id' => 'required'
        ]);
    
        // Find the application
        $application = CompetitionApplication::findOrFail($request->application_id);
    
        // Update the application status and remarks
        $application->status = $request->status;
        $application->remarks = $request->remarks ?? $application->remarks;
        $application->save();
    
        // If status is "Approved," insert data into the competitors table
        if ($request->status === 'Approved') {
            try {
                Competitor::create([
                    'full_name' => $application->name,
                    'id_card_number' => $application->id_card,
                    'address' => $application->permanent_address,
                    'island_city' => $application->city,
                    'school_name' => $application->organization ?? '', // Default empty string if NULL
                    'parent_name' => $application->parent_name ?? '', // Default empty string if NULL
                    'phone_number' => $application->number,
                    'competition_id' => $application->competition_id,
                    'side_category_id' => $application->side_category,
                    'read_category_id' => $application->read_category,
                    'age_category_id' => $application->age_category,
                    'number_of_questions' => 0, // Default value
                    'status' => 'ongoing', // Default status for competitors
                ]);
            } catch (\Exception $e) {
                // Log the error or handle it as needed
                return redirect()->route('registrations.index', ['status' => $request->status])
                    ->with('error', 'Failed to create competitor: ' . $e->getMessage());
            }
        }
    
        return redirect()->route('registrations.index', ['status' => $request->status])
            ->with('success', 'Application status updated successfully.');
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
        $pdf = Pdf::loadView('client.quran-reports.reportParticipant', compact('competition', 'ageCategory', 'recitationPiece', 'recitationMethod'));

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

        return redirect()->route('report.index',['status' => $request->status])->with('success', 'Participant report generated successfully!');

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
        $pdf = Pdf::loadView('client.quran-reports.reportParticipant', compact('competition', 'ageCategory', 'recitationPiece', 'recitationMethod'));

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

        return redirect()->route('report.index',['status' => $request->status])->with('success', 'Sponsor report generated successfully!');

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
          $pdf = Pdf::loadView('client.quran-reports.reportParticipant', compact('competition', 'ageCategory', 'recitationPiece', 'recitationMethod'));
  
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
  
          return redirect()->route('report.index',['status' => $request->status])->with('success', 'Winners report generated successfully!');
    }

}
