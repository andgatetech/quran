<?php

namespace App\Http\Controllers;

use App\Models\AgeCategory;
use App\Models\Competition;
use App\Models\CompetitionApplication;
use App\Models\ReadCategory;
use App\Models\SideCategory;
use Illuminate\Http\Request;

class RegistrationRequestController extends Controller
{
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
        $competitions = Competition::where('status','On-Going')->get();
        $side_categories = SideCategory::get();
        $read_categories = ReadCategory::get();
        $age_categories = AgeCategory::get();

        return view('client.registrations.index',compact('applications','competitions','status',
        'side_categories','read_categories','age_categories'));

    }
    public function updateStatus(Request $request)
    {
        $request->validate([
            'application_id' => 'required'
        ]);
        $application = CompetitionApplication::findOrFail($request->application_id);
        $application->status = $request->status;
        $application->remarks = $request->remarks ?? $application->remarks ;
        $application->save();
        return redirect()->route('registrations.index',['status'=>$request->status]);

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
