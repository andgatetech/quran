<?php

namespace App\Http\Controllers\Quran;

use App\Models\CompetitionType;
use App\Models\SideCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RecitationPieceController extends Controller
{
    private $module = "Quran";
    private $competitionType;

    public function __construct(){
        // find competition type;
        $this->competitionType = CompetitionType::where('name', 'Quran')->first();
    }
    // Show the create side category form
    public function create()
    {
        return view('client.quran.recitation.piece.create');
    }

    // Store a new side category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        SideCategory::create([
            'competition_type_id' => $this->competitionType->id,
            'user_id' => Auth::id(), // ID of the logged-in user
            'name' => $request->name,
        ]);

        return redirect()->route('quran.recitation.piece.list')->with('success', 'Recitation Piece created successfully!');
    }
    public function index()
    {
        $recitationPieces = SideCategory::where([
            ['user_id', '=', Auth::id()],
            ['competition_type_id', '=', $this->competitionType->id],
        ])->get();
        return view('client.quran.recitation.piece.list', compact('recitationPieces'));
    }

    // Show edit form
    public function edit($id)
    {
        $recitationPiece = SideCategory::findOrFail($id);

        if (!$recitationPiece) {
            return redirect()->route('quran.recitation.piece.list')->with('error', 'No category selected for editing.');
        }

        

        // Pass the data to the edit view
        return view('client.quran.recitation.piece.edit', compact('recitationPiece'));
    }

    // Update the side category
    public function update($id, Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $recitationPiece = SideCategory::findOrFail($id);
        $recitationPiece->update([
            'name' => $request->name,
        ]);

        return redirect()->route('quran.recitation.piece.list')->with('success', 'Recitation Piece updated successfully!');
    }

    // Delete the side category
    public function destroy($id)
    {
        $recitationPiece = SideCategory::findOrFail($id);
        $recitationPiece->delete();

        return redirect()->route('quran.recitation.piece.list')->with('success', 'Recitation Piece deleted successfully!');
    }


}
