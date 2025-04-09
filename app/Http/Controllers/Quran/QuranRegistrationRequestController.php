<?php

namespace App\Http\Controllers\Quran;

use App\Models\AgeCategory;
use App\Models\Competition;
use App\Models\CompetitionApplication;
use App\Models\CompetitionType;
use App\Models\ReadCategory;
use App\Models\SideCategory;
use App\Models\Competitor;
use Illuminate\Routing\Controller;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuranRegistrationRequestController extends Controller
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
        $status = request()->status ?? 'Pending';
        $competition_id = request()->competition ?? null;
        $age_category = request()->age_category ?? null;
        $side_category = request()->side_category ?? null;
        $read_category = request()->read_category ?? null;
        $applications = CompetitionApplication::where('status',$status)
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
        $competitions = Competition::where([
            ['user_id', '=', Auth::guard('client')->id()],
            ['competition_type_id', '=', $this->competitionType->id],
        ])->where('status','On-Going')->get();
        $side_categories = SideCategory::where([
            ['user_id', '=', Auth::guard('client')->id()],
            ['competition_type_id', '=', $this->competitionType->id],
        ])->get();
        $read_categories = ReadCategory::where([
            ['user_id', '=', Auth::guard('client')->id()],
            ['competition_type_id', '=', $this->competitionType->id],
        ])->get();
        $age_categories = AgeCategory::where([
            ['user_id', '=', Auth::guard('client')->id()],
            ['competition_type_id', '=', $this->competitionType->id],
        ])->get();

        return view('client.quran.registrations.index',compact('applications','competitions','status',
        'side_categories','read_categories','age_categories'));

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
        $application->number_of_questions = $request->number_of_questions;
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
                    'number_of_questions' => $application->number_of_questions, // Default value
                    'status' => 'ongoing', // Default status for competitors
                ]);
            } catch (\Exception $e) {
                // Log the error or handle it as needed
                return redirect()->route('quran.competition.applicant.list', ['status' => $request->status])
                    ->with('error', 'Failed to create competitor: ' . $e->getMessage());
            }
        }
    
        return redirect()->route('quran.competition.applicant.list', ['status' => $request->status])
            ->with('success', 'Application status updated successfully.');
    }

}
