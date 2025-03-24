<?php

namespace App\Http\Controllers;

use App\Models\Quran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class QuranController extends Controller
{
    public function fetchAyahs(Request $request)
    {
        $bookNumber = $request->input('book_number');

        // Validate the input
        if (!is_numeric($bookNumber) || $bookNumber < 1 || $bookNumber > 30) {
            return response()->json([], 400); // Invalid input
        }

        // Fetch ayahs from the Quran database based on the selected book_number
        $ayahs = Quran::where('juz_no', $bookNumber)
            ->orderBy('ayah_no_juzz')
            ->get(['ayah_no_juzz']); // Fetch only ayah numbers

        return response()->json($ayahs);
    }


    // public function fetchAyats(Request $request)
    // {
    //     // Validate the input
    //     $request->validate([
    //         'juz_number' => 'required|integer|min:1|max:30',
    //         'from_verse' => 'required|integer|min:1',
    //         'to_verse' => 'required|integer|min:1|gte:from_verse',
    //     ]);

    //     // Fetch the input values
    //     $juzNumber = $request->input('juz_number');
    //     $fromVerse = $request->input('from_verse');
    //     $toVerse = $request->input('to_verse');

    //     try {
    //         // Query the Quran model for the verses
    //         $verses = Quran::where('juz_no', $juzNumber)
    //             ->whereBetween('ayah_no_quran', [$fromVerse, $toVerse])
    //             ->orderBy('ayah_no_quran', 'asc')
    //             ->get(['ayah_no_quran', 'ayah_ar', 'ayah_en']);

    //         if ($verses->isEmpty()) {
    //             return back()->with('error', 'No verses found for this range.');
    //         }

    //         // Return the verses to the view
    //         return view('quran.ayats', compact('verses'));

    //     } catch (\Exception $e) {
    //         // Log the error and return an error message
    //         Log::error('Error fetching Quran verses: ' . $e->getMessage());
    //         return back()->with('error', 'Unable to fetch verses at the moment.');
    //     }
    // }
}
