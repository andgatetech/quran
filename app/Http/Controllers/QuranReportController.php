<?php

namespace App\Http\Controllers;

use App\Models\AgeCategory;
use App\Models\Competition;
use App\Models\CompetitionApplication;
use App\Models\ReadCategory;
use App\Models\SideCategory;
use App\Models\Competitor;


use Illuminate\Http\Request;

class QuranReportController extends Controller
{
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
        if($status=="Participants"){
            return view('client.quran-reports.index',compact('applications','competitions','status',
            'side_categories','read_categories','age_categories'));
        }else if($status=="Sponsers"){
            return view('client.quran-reports.sponsers',compact('applications','competitions','status',
            'side_categories','read_categories','age_categories'));
        }else{
            return view('client.quran-reports.winners',compact('applications','competitions','status',
            'side_categories','read_categories','age_categories'));
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
