<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use App\Models\Competition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Container\Attributes\Log;

class SponsorController extends Controller
{
    /**
     * Display a listing of the sponsors.
     */
    public function index()
    {
        // Fetch sponsors for the logged-in user
        $sponsors = Sponsor::where('user_id', Auth::id())->get(); // Filter by user_id

        return view('client.sponsor.list', compact('sponsors'));
    }



    /**
     * Show the form for creating a new sponsor.
     */
    public function create()
    {
        // Fetch all competitions and pass them to the view
        $competitions = Competition::where('user_id', Auth::id())->get();
        return view('client.sponsor.create', compact('competitions'));

    }


    /**
     * Store a newly created sponsor in storage.
     */
    public function store(Request $request)
    {
        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'competition_id' => 'required', // Ensure competition exists
            'logo' => 'nullable', // Optional logo
        ]);

        // Initialize the Sponsor data
        $sponsorData = [
            'name' => $validatedData['name'],
            'competition_id' => $validatedData['competition_id'],
            'user_id' => Auth::id(),
        ];

        // Handle the logo upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('sponsors'), $fileName);
            $sponsorData['logo'] = 'sponsors/' . $fileName;
        }

        // Save the sponsor record
        try {
            Sponsor::create($sponsorData);
            return redirect()->route('sponsors.create')->with('success', 'Sponsor created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('sponsors.create')->with('error', 'Failed to create sponsor: ' . $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'competition_id' => 'required', // Ensure competition exists
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional logo with validation
        ]);

        try {
            // Find the sponsor record
            $sponsor = Sponsor::findOrFail($id);

            // Prepare sponsor data
            $sponsorData = [
                'name' => $validatedData['name'],
                'competition_id' => $validatedData['competition_id'],
            ];

            // Handle file upload if a new logo is provided
            if ($request->hasFile('logo')) {
                // Delete the old logo if it exists
                if ($sponsor->logo && file_exists(public_path($sponsor->logo))) {
                    unlink(public_path($sponsor->logo));
                }

                // Upload the new logo
                $file = $request->file('logo');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('sponsors'), $fileName);
                $sponsorData['logo'] = 'sponsors/' . $fileName;
            } else {
                // Retain the old logo if no new one is uploaded
                $sponsorData['logo'] = $sponsor->logo;
            }

            // Update the sponsor record
            $sponsor->update($sponsorData);

            // Redirect to sponsor list with success message
            return redirect()->route('sponsors.index')->with('success', 'Sponsor updated successfully!');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error updating sponsor: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->with('error', 'Failed to update sponsor. Please try again.');
        }
    }


    /**
     * Show the form for editing the specified sponsor.
     */
    public function edit($id)
    {
        $sponsor = Sponsor::with('competition')->findOrFail($id);
        $competitions = Competition::where('user_id', Auth::id())->get();

        return view('client.sponsor.edit', compact('sponsor','competitions'));
    }

    /**
     * Update the specified sponsor in storage.
     */


    /**
     * Remove the specified sponsor from storage.
     */
    public function destroy($id)
    {
        try {
            $sponsor = Sponsor::findOrFail($id);

            // Delete logo if exists
            if ($sponsor->logo && Storage::disk('public')->exists($sponsor->logo)) {
                Storage::disk('public')->delete($sponsor->logo);
            }

            // Delete the sponsor
            $sponsor->delete();

            // Redirect to sponsor list with success message
            return redirect()->route('sponsors.index')->with('success', 'Sponsor deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting sponsor: ' . $e->getMessage());
            return redirect()->route('sponsors.index')->with('error', 'Failed to delete sponsor. Please try again.');
        }
    }

    /**
     * Display the specified sponsor.
     */
    public function show($id)
    {
        $sponsor = Sponsor::with('competition')->findOrFail($id);
        $competitions = Competition::where('user_id', Auth::id())->get();

        return view('client.sponsor.view', compact('sponsor','competitions'));
    }
}
