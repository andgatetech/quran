<?php

namespace App\Http\Controllers\Quran;

use App\Models\CompetitionType;
use App\Models\ReadCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RecitationMethodController extends Controller
{
    private $module = "Quran";
    private $competitionType;

    public function __construct(){
        // find competition type;
        $this->competitionType = CompetitionType::where('name', 'Quran')->first();
    }

    // Show the create form
    public function create()
    {
        return view('client.quran.recitation.method.create');
    }

    // Store the read category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ReadCategory::create([
            'competition_type_id' => $this->competitionType->id,
            'user_id' => Auth::guard('client')->id(), // ID of the logged-in user
            'name' => $request->name,
        ]);

        return redirect()->route('quran.recitation.method.list')->with('success', 'Recitation Method created successfully!');
    }

    // List all read categories
    public function index()
    {
        $recitationMethods = ReadCategory::where([
                                                        ['user_id', '=', Auth::guard('client')->id()],
                                                        ['competition_type_id', '=', $this->competitionType->id],
                                                    ])->get();
        return view('client.quran.recitation.method.list', compact('recitationMethods'));
    }

    // Show edit form
    public function edit($id)
    {
        $recitationMethod = ReadCategory::findOrFail($id);

        if (!$recitationMethod) {
            return redirect()->route('quran.recitation.method.list')->with('error', 'No category selected for editing.');
        }

        
        return view('client.quran.recitation.method.edit', compact('recitationMethod'));
    }

    // Update the read category
    public function update($id, Request $request)
    {
        $recitationMethod = ReadCategory::findOrFail($id);

        if (!$recitationMethod) {
            return redirect()->route('quran.recitation.method.list')->with('error', 'No category selected for updating.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $recitationMethod->update([
            'name' => $request->name,
        ]);

        return redirect()->route('quran.recitation.method.list')->with('success', 'Recitation Method updated successfully!');
    }

    // Delete a read category
    public function destroy($id, Request $request)
    {
        $recitationMethod = ReadCategory::findOrFail($id);
        $recitationMethod->delete();

        return redirect()->route('quran.recitation.method.list')->with('success', 'Recitation Method deleted successfully!');
    }
}
