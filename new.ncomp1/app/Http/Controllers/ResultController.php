<?php

namespace App\Http\Controllers;

use App\Models\Judge;
use App\Models\Result;
use App\Models\Competitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResultController extends Controller
{
    public function storeResults(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'competitor_id' => 'required|integer',
            'competition_id' => 'required|integer',
            'judge_id' => 'required|integer',
            'point_category_id' => 'required|array',
            'total_points' => 'required|array',
            'gained_points' => 'required|array',
        ]);

        $competitorId = $request->competitor_id;
        $competitionId = $request->competition_id;
        $judge_id = $request->judge_id;

        $pointCategoryIds = $request->point_category_id;
        $totalPoints = $request->total_points;
        $gainedPoints = $request->gained_points;

        foreach ($pointCategoryIds as $index => $pointCategoryId) {
            Result::create([
                'competitor_id' => $competitorId,
                'competition_id' => $competitionId,
                'judge_id' => $judge_id,
                'point_category_id' => $pointCategoryId,
                'total_points' => $totalPoints[$index],
                'gained_points' => $gainedPoints[$index],
                'status' => 'completed',
            ]);
        }















        $competition_id = session('competition_id');


        $totalJudgesInCompetition = Judge::where('competition_id', $competition_id)->count();

        $totalJudgesInResult = Competitor::join('results', 'results.competitor_id', '=', 'competitors.id')
        ->where('results.competition_id', $competition_id)
        ->where('competitors.status', 'ongoing')
        ->distinct()
        ->count('results.judge_id');

        if ($totalJudgesInResult == $totalJudgesInCompetition) {

            Competitor::where('competition_id', $competition_id)
                ->where('status', 'ongoing')
                ->update(['status' => 'performed']);

        }


        return redirect()->back()->with('success', 'Results stored successfully!');
    }









































    // Redirect back if the competitor is not found
}

