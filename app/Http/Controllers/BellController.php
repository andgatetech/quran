<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Jobs\DeactivateBell;
use Illuminate\Http\Request;
use App\Models\BellNotification;
use Illuminate\Routing\Controller;

class BellController extends Controller
{

    public function deactivateBell(Request $request)
    {
        Log::info('Deactivate Bell Request:', $request->all());

        $request->validate([
            'competitor_id'  => 'required|integer',
            'competition_id' => 'required|integer',
            'judge_id'       => 'required|integer', // Ensure judge_id is provided
        ]);

        // Update the bell notification to set is_active to false
        $updated = BellNotification::where('competitor_id', $request->competitor_id)
            ->where('competition_id', $request->competition_id)
            ->where('judge_id', $request->judge_id) // Match the judge_id
            ->update(['is_active' => false]);

        if ($updated) {
            Log::info('Bell notification deactivated.');
            return response()->json(['message' => 'Bell deactivated successfully'], 200);
        } else {
            Log::warning('Bell notification not found or already deactivated.');
            return response()->json(['message' => 'Bell not found or already deactivated'], 404);
        }
    }

    public function triggerBell(Request $request)
    {
        Log::info('Trigger Bell Request:', $request->all()); // Log the incoming request data

        $request->validate([
            'competitor_id'  => 'required|integer',
            'competition_id' => 'required|integer',
            'judge_id'       => 'required|integer', // Ensure judge_id is included
        ]);

        Log::info('Request validation passed.');

        // Activate the bell and set 'activated_at' timestamp with judge_id
        BellNotification::updateOrCreate(
            [
                'competitor_id' => $request->competitor_id,
                'competition_id' => $request->competition_id
            ],
            [
                'is_active' => true,
                'activated_at' => now(),
                'judge_id' => $request->judge_id // Add judge_id to the record
            ]
        );

        Log::info('Bell notification created or updated.');

        return response()->json(['message' => 'Bell triggered successfully']);
    }


    public function getActiveBells(Request $request)
    {
        $competition_id = session('competition_id');
        $competitor_id = $request->input('competitor_id'); // Get competitor_id from the request

        // Fetch active bell notifications, ensuring their status is ongoing
        $activeBellsQuery = BellNotification::join('competitors', 'bell_notifications.competitor_id', '=', 'competitors.id') // Match competitor_id
            ->join('judges', 'bell_notifications.judge_id', '=', 'judges.id') // Join with judges table
            ->where('bell_notifications.competition_id', $competition_id)
            ->where('bell_notifications.is_active', true)
            ->where('competitors.status', 'ongoing'); // Ensure competitor status is 'ongoing'

        // If a specific competitor_id is provided, filter the results
        if ($competitor_id) {
            $activeBellsQuery->where('bell_notifications.competitor_id', $competitor_id);
        }

        $activeBells = $activeBellsQuery
            ->select(
                'judges.full_name as judge_name',
                'competitions.main_name as competition_name',
                'bell_notifications.is_active'
            )
            ->join('competitions', 'bell_notifications.competition_id', '=', 'competitions.id') // Join with competitions table
            ->get();

        return response()->json($activeBells);
    }

}
