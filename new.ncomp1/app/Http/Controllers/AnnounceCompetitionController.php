<?php

namespace App\Http\Controllers;

use App\Models\AgeCategory;
use App\Models\Competition;
use App\Models\CompetitionApplication;
use App\Models\ReadCategory;
use App\Models\SideCategory;
use Illuminate\Http\Request;

class AnnounceCompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $competitions = Competition::where('status','On-Going')
        ->orderBy('updated_at','desc')->get(); // Fetch competitions for logged-in user
        // dd($competitions);
        return view('client.announce-competition.list',compact('competitions')); // Path to your Blade file

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            $competitions = Competition::where('status','Pending')->get(); // Fetch competitions for logged-in user
            return view('client.announce-competition.create',compact('competitions')); // Path to your Blade file
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'competition_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'no_of_days' => 'required',
            'url' => 'required'
        ]);
        $competition = Competition::findOrFail($request->competition_id);
        $competition->status = 'On-Going';
        $competition->start_date = $request->start_date;
        $competition->end_date = $request->end_date;
        $competition->no_of_days = $request->no_of_days;
        $competition->url = $request->url;
        $competition->encrypted_id = $request->encrypted_id;
        $competition->save();
        return redirect()->route('announce-list.index')->with('success', 'Competition announced successfully!');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $competition = Competition::where('encrypted_id',$id)->firstOrFail();
        $age_categories = AgeCategory::get();
        $read_categories = ReadCategory::get();
        $side_categories = SideCategory::get();

        return view("client.announce-competition.show",compact('competition','side_categories','read_categories','age_categories'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $competition = Competition::findOrFail($id);
        $competitions = Competition::where('status','Pending')->get(); // Fetch competitions for logged-in user
        return view('client.announce-competition.create',compact('competitions','competition')); // Path to your Blade file
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'competition_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'no_of_days' => 'required',
            'url' => 'required'
        ]);
        $competition = Competition::findOrFail($id);
        $competition->start_date = $request->start_date;
        $competition->end_date = $request->end_date;
        $competition->no_of_days = $request->no_of_days;
        $competition->url = $request->url;
        $competition->save();
        return redirect()->route('announce-list.index')->with('success', 'Data Updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $competition = Competition::findOrFail($id);
        $competition->delete();
        return redirect()->route('announce-list.index')->with('success', 'Competition deleted successfully!');

    }
    public function apply(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'id_card' => 'required',
            'permanent_address' => 'required',
            'current_address' => 'required',
            'city' => 'required',
            'dob' => 'required',
            'age' => 'required',
            'organization' => 'required',
            'number' => 'required',
            'age_category' => 'required',
            'side_category' => 'required',
            'read_category' => 'required',
            'competition_id' => 'required',
            'photo' => 'required|mimes:jpg,jpeg,png|max:2048', // 2MB max
            'id_card_photo' => 'required|mimes:jpg,jpeg,png,pdf|max:2048', // 2MB max
        ]);
        $application = new CompetitionApplication();
        $application->competition_id = $request->competition_id;
        $application->name = $request->name;
        $application->id_card = $request->id_card;
        $application->permanent_address = $request->permanent_address;
        $application->current_address = $request->current_address;
        $application->city = $request->city;
        $application->age = $request->age;
        $application->dob = $request->dob;
        $application->organization = $request->organization;
        $application->number = $request->number;
        $application->age_category = $request->age_category;
        $application->side_category = $request->side_category;
        $application->read_category = $request->read_category;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->move(public_path('assets/img'), $request->file('photo')->getClientOriginalName());
            $application->photo = 'assets/img/' . $request->file('photo')->getClientOriginalName();
        }

        // Save the 'id_card_photo' file
        if ($request->hasFile('id_card_photo')) {
            $idCardPath = $request->file('id_card_photo')->move(public_path('assets/img'), $request->file('id_card_photo')->getClientOriginalName());
            $application->id_card_photo = 'assets/img/' . $request->file('id_card_photo')->getClientOriginalName();
        }
        $application->save();
        return redirect()->back()->with('success', 'Application submitted successfully!');

    }
}
