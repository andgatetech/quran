<?php

namespace App\Http\Controllers\Poetry;

use App\Models\SideCategory;
use App\Models\CompetitionType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PoetrySideCategoryController extends Controller
{
    private $module = "Poetry";
    // Show the create side category form
    public function create()
    {
        return view('client.poetry.sidecategory.addsidecategory');
    }

    // Store a new side category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $competitionType = CompetitionType::where('name', 'Poetry')->first();
        SideCategory::create([
            'competition_type_id' => $competitionType->id,
            'user_id' => Auth::guard('client')->id(), // ID of the logged-in user
            'name' => $request->name,
        ]);
        return redirect()->route('poetry.sidecategory.list')->with('success', 'Side Category created successfully!');
    }
    public function index()
    {
        $competitionType = CompetitionType::where('name', 'Poetry')->first();
        $sideCategories = SideCategory::where('user_id', Auth::guard('client')->id())
        ->where('competition_type_id',$competitionType->id)
        ->get();
        return view('client.poetry.sidecategory.sidecategorylist', compact('sideCategories'));
    }

    

    // Show edit form
    public function edit($id)
    {

        $sideCategory = SideCategory::findOrFail($id);
        if (!$sideCategory) {
            return redirect()->route('poetry.sidecategory.list')->with('error', 'No category selected for editing.');
        }
        // Pass the data to the edit view
        return view('client.poetry.sidecategory.editsidecategory', compact('sideCategory'));
    }

    // Update the side category
    public function update($id,Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $sideCategory = SideCategory::findOrFail($id);
        $sideCategory->update([
            'name' => $request->name,
        ]);

        return redirect()->route('poetry.sidecategory.list')->with('success', 'Side Category updated successfully!');
    }

    // Delete the side category
    public function destroy($id)
    {   
        $sideCategory = SideCategory::findOrFail($id);
        $sideCategory->delete();
        return redirect()->route('poetry.sidecategory.list')->with('success', 'Side Category deleted successfully!');
    }


}
