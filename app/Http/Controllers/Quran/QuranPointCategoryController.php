<?php
namespace App\Http\Controllers\Quran;

use App\Models\CompetitionType;
use Illuminate\Http\Request;
use App\Models\PointCategory;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class QuranPointCategoryController extends Controller
{
    private $module = "Quran";
    private $competitionType;

    public function __construct(){
        // find competition type;
        $this->competitionType = CompetitionType::where('name', 'Quran')->first();
    }

    public function create()
    {
        return view('client.quran.pointcategory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'total_points' => 'required|integer',
            'deduction_amount' => 'required|numeric',
        ]);

        PointCategory::create([
            'competition_type_id' => $this->competitionType->id,
            'user_id' => Auth::id(),
            'name' => $request->name,
            'total_points' => $request->total_points,
            'deduction_amount' => $request->deduction_amount,
        ]);

        return redirect()->route('quran.pointcategory.list')->with('success', 'Point Category created successfully!');
    }

    public function index()
    {
        $pointCategories = PointCategory::where('user_id', Auth::id())->get();
        return view('client.quran.pointcategory.list', compact('pointCategories'));
    }

    // Edit page for the selected point category
    public function edit($id)
    {
        $pointCategory = PointCategory::findOrFail($id);
        if (!$pointCategory) {
            return redirect()->route('quran.pointcategory.list')->with('error', 'No category selected for editing.');
        }


        return view('client.quran.pointcategory.edit', compact('pointCategory'));
    }

    // Update the selected point category
    public function update($id, Request $request)
    {
        $pointCategory = PointCategory::findOrFail($id);
        if (!$pointCategory) {
            return redirect()->route('pointcategory.list')->with('error', 'No category selected for updating.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'total_points' => 'required|integer',
            'deduction_amount' => 'required|numeric',
        ]);


        $pointCategory->update([
            'name' => $request->name,
            'total_points' => $request->total_points,
            'deduction_amount' => $request->deduction_amount,
        ]);

        Session::forget('point_category_id');
        return redirect()->route('quran.pointcategory.list')->with('success', 'Point Category updated successfully!');
    }

    public function destroy($id, Request $request)
    {
        $pointCategory = PointCategory::findOrFail($id);
        $pointCategory->delete();

        return redirect()->route('quran.pointcategory.list')->with('success', 'Point Category deleted successfully!');
    }
}
