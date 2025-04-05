<?php

namespace App\Http\Controllers\Quran;

use Carbon\Carbon;
use App\Models\Host;
use App\Models\Competition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class QuranHostController extends Controller
{


    public function create()
    {
        // Fetch competitions for the logged-in user
        $competitions = Competition::where('user_id', Auth::id())->get(); // Filter by user_id

        // Pass the data to the view
        return view('client.quran.host.create', compact('competitions'));
    }


    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'competition_id' => 'required|exists:competitions,id',
            'host_id' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        // Store data in the database
        $host = Host::create([
            'competition_id' => $request->competition_id,
            'host_id' => $request->host_id,
            'password' => bcrypt($request->password), // Store encrypted password
            'user_id' => Auth::id(), // Store the user_id of the logged-in user
        ]);

        return redirect()->route('quran.host.create')->with('success', 'Competition hosted successfully');
    }

        // Method to show the competition list
    public function competitionList()
    {
        // Fetch the data by joining 'hosts' and 'competitions' tables, filtered by the logged-in user
        $hosts = DB::table('hosts')
            ->join('competitions', 'hosts.competition_id', '=', 'competitions.id')
            ->select('hosts.*', 'competitions.main_name', 'competitions.sub_name')
            ->where('hosts.user_id', Auth::id()) // Filter by user_id
            ->get();

        // Pass the data to the view
        return view('client.quran.host.competition-list', compact('hosts'));
    }

        // Method to show the announce winners page
    public function continue($id)
    {
        // Find the host by ID
        $host = Host::findOrFail($id);

        // Update status to 'done' and update the updated_at timestamp
        $host->status = 'done';
        $host->updated_at = Carbon::now(); // Or use $host->touch() to just update the timestamp
        $host->save();

        // Redirect back to the list with a success message
        return redirect()->route('quran.competitions.list')->with('success', 'Host status updated to done.');
    }

}
