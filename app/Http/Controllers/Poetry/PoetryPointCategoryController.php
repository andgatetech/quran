<?php
namespace App\Http\Controllers\Poetry;

use Illuminate\Http\Request;
use App\Models\PointCategory;
use App\Models\CompetitionType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PoetryPointCategoryController extends Controller
{
    private $module = "Poetry";
    public function create()
    {
         return view('client.poetry.pointcategory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'total_points' => 'required|integer',
            'deduction_amount' => 'required|numeric',
        ]);

        $competitionType = CompetitionType::where('name', 'Poetry')->first();
        PointCategory::create([
            'competition_type_id' => $competitionType->id,
            'user_id' => Auth::guard('client')->id(),
            'name' => $request->name,
            'total_points' => $request->total_points,
            'deduction_amount' => $request->deduction_amount,
        ]);

        return redirect()->route('poetry.pointcategory.list')->with('success', 'Point Category created successfully!');
    }

    public function index()
    {
        $competitionType = CompetitionType::where('name', 'Poetry')->first();
        $pointCategories = PointCategory::where('user_id', Auth::guard('client')->id())
        ->where('competition_type_id',$competitionType->id)
        ->get();
        return view('client.poetry.pointcategory.list', compact('pointCategories'));
    }

   

    // Edit page for the selected point category
    public function edit($id)
    {
        $pointCategory = PointCategory::findOrFail($id);
        if (!$pointCategory) {
            return redirect()->route('poetry.pointcategory.list')->with('error', 'No category selected for editing.');
        }

        return view('client.poetry.pointcategory.edit', compact('pointCategory'));
    }

    // Update the selected point category
    public function update($id,Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'total_points' => 'required|integer',
            'deduction_amount' => 'required|numeric',
        ]);

        $pointCategory = PointCategory::findOrFail($id);
        $pointCategory->update([
            'name' => $request->name,
            'total_points' => $request->total_points,
            'deduction_amount' => $request->deduction_amount,
        ]);

        return redirect()->route('poetry.pointcategory.list')->with('success', 'Point Category updated successfully!');
    }

    public function destroy($id)
    {
        $pointCategory = PointCategory::findOrFail($id);
        $pointCategory->delete();
        return redirect()->route('poetry.pointcategory.list')->with('success', 'Point Category deleted successfully!');
    }
}
