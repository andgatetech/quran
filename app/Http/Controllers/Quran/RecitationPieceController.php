<?php

namespace App\Http\Controllers\Quran;

use App\Models\SideCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RecitationPieceController extends Controller
{
    // Show the create side category form
    public function create()
    {
        return view('client.quran.recitation.piece.recitation-piece-add');
    }

    // Store a new side category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        SideCategory::create([
            'user_id' => Auth::id(), // ID of the logged-in user
            'name' => $request->name,
        ]);

        return redirect()->route('quran.recitation.piece.list')->with('success', 'Side Category created successfully!');
    }
    public function index()
    {
        $sideCategories = SideCategory::where('user_id', Auth::id())->get();
        return view('client.quran.recitation.piece.recitation-piece-list', compact('sideCategories'));
    }

    // Set session for the side category to be edited
    public function setSession(Request $request)
    {
        $request->validate([
            'side_category_id' => 'required|exists:side_categories,id',
        ]);

        Session::put('side_category_id', $request->side_category_id);

        return redirect()->route('quran.recitation.piece.edit');
    }

    // Show edit form
    public function edit($id)
    {
        $sideCategory = SideCategory::findOrFail($id);

        if (!$sideCategory) {
            return redirect()->route('quran.recitation.piece.list')->with('error', 'No category selected for editing.');
        }

        

        // Pass the data to the edit view
        return view('client.quran.recitation.piece.recitation-piece-edit', compact('sideCategory'));
    }

    // Update the side category
    public function update(Request $request)
    {
        $sideCategoryId = Session::get('side_category_id');

        if (!$sideCategoryId) {
            return redirect()->route('quran.recitation.piece.list')->with('error', 'No category selected for updating.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $sideCategory = SideCategory::findOrFail($sideCategoryId);
        $sideCategory->update([
            'name' => $request->name,
        ]);

        Session::forget('side_category_id');

        return redirect()->route('quran.recitation.piece.list')->with('success', 'Side Category updated successfully!');
    }

    // Delete the side category
    public function destroy($id)
    {
        $sideCategory = SideCategory::findOrFail($id);
        $sideCategory->delete();

        return redirect()->route('quran.recitation.piece.list')->with('success', 'Side Category deleted successfully!');
    }


}
