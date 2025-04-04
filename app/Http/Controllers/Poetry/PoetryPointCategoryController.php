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
            'user_id' => Auth::id(),
            'name' => $request->name,
            'total_points' => $request->total_points,
            'deduction_amount' => $request->deduction_amount,
        ]);

        return redirect()->route('poetry.pointcategory.list')->with('success', 'Point Category created successfully!');
    }

    public function index()
    {
        $competitionType = CompetitionType::where('name', 'Poetry')->first();
        $pointCategories = PointCategory::where('user_id', Auth::id())
        ->where('competition_type_id',$competitionType->id)
        ->get();
        return view('client.poetry.pointcategory.list', compact('pointCategories'));
    }

    // Set session for the selected point category
    public function setSession(Request $request)
    {
        $request->validate(['point_category_id' => 'required|exists:point_categories,id']);
        Session::put('point_category_id', $request->point_category_id);
        return redirect()->route('poetry.pointcategory.edit');
    }

    // Edit page for the selected point category
    public function edit()
    {
        $pointCategoryId = Session::get('point_category_id');
        if (!$pointCategoryId) {
            return redirect()->route('poetry.pointcategory.list')->with('error', 'No category selected for editing.');
        }

        $pointCategory = PointCategory::findOrFail($pointCategoryId);
        return view('client.poetry.pointcategory.edit', compact('pointCategory'));
    }

    // Update the selected point category
    public function update(Request $request)
    {
        $pointCategoryId = Session::get('point_category_id');
        if (!$pointCategoryId) {
            return redirect()->route('poetry.pointcategory.list')->with('error', 'No category selected for updating.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'total_points' => 'required|integer',
            'deduction_amount' => 'required|numeric',
        ]);

        $pointCategory = PointCategory::findOrFail($pointCategoryId);
        $pointCategory->update([
            'name' => $request->name,
            'total_points' => $request->total_points,
            'deduction_amount' => $request->deduction_amount,
        ]);

        Session::forget('point_category_id');
        return redirect()->route('poetry.pointcategory.list')->with('success', 'Point Category updated successfully!');
    }

    public function destroy(Request $request)
    {
        $request->validate(['point_category_id' => 'required|exists:point_categories,id']);
        $pointCategory = PointCategory::findOrFail($request->point_category_id);
        $pointCategory->delete();
        return redirect()->route('poetry.pointcategory.list')->with('success', 'Point Category deleted successfully!');
    }
}
