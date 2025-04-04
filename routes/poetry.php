<?php
use App\Http\Controllers\ClientLoginController;
use App\Http\Controllers\Poetry\PoetryAnnounceCompetitionController;
use App\Http\Controllers\Poetry\PoetryCompetitionController;
use App\Http\Controllers\Poetry\PoetryRegistrationRequestController;
use App\Http\Middleware\CheckSession;
use Illuminate\Support\Facades\Route;
// PDF view and Download Route
use App\Http\Controllers\PDFController;


Route::prefix('client')->group(function () {
    // MENU
    Route::get('top/menu', [ClientLoginController::class, 'clientTopMenu'])->name('client.menu');
    Route::get('poetry/menu', function () {
        if (!Auth::check()) {
            // Redirect to login page if not authenticated
            return redirect()->route('client.login')->with('error', 'You must be logged in to access this page.');
        }
        // Display the menu page if authenticated
        return view('client.menu.poetry-menu');
    })->name('client.menu.poetry');

    // QURAN MODULE
    Route::prefix('poetry')->group(function () {
        // COMPETITION ANNOUNCE
        Route::get('competition/announce/create', [PoetryAnnounceCompetitionController::class, 'create'])->name('poetry.competition.announce.create');
        Route::post('competition/announce/store', [PoetryAnnounceCompetitionController::class, 'store'])->name('poetry.competition.announce.store');
        Route::get('competition/announce/list', [PoetryAnnounceCompetitionController::class, 'index'])->name('poetry.competition.announce.list');
        Route::get('competition/announce/edit/{id}', [PoetryAnnounceCompetitionController::class, 'edit'])->name('poetry.competition.announce.edit');
        Route::put('competition/announce/update/{id}', [PoetryAnnounceCompetitionController::class, 'update'])->name('poetry.competition.announce.update');
        Route::delete('competition/announce/{id}',[PoetryAnnounceCompetitionController::class, 'destroy'])->name('poetry.competition.announce.delete');

        // COMPETITION
        Route::get('competition/create', [PoetryCompetitionController::class, 'create'])->name('poetry.competition.create');
        Route::post('competition/store', [PoetryCompetitionController::class, 'store'])->name('poetry.competition.store');
        Route::get('competition/list', [PoetryCompetitionController::class, 'index'])->name('poetry.competition.list');

        // Route to edit a competition
        Route::get('competition/edit/{id}', [PoetryCompetitionController::class, 'edit'])->name('poetry.competition.edit');
        Route::put('competition/update/{id}', [PoetryCompetitionController::class, 'update'])->name('poetry.competition.update');
        Route::delete('competition/delete/{id}', [PoetryCompetitionController::class, 'destroy'])->name('poetry.competition.delete');

        // APPLICANTS WHO APPLIED TO PARTICIPATE
        Route::get('applicant/participate/registration', [PoetryRegistrationRequestController::class,'index'])->name('poetry.competition.applicant.list');
        Route::post('applicant/participate/status/update',[PoetryRegistrationRequestController::class , 'updateStatus'])->name('poetry.competition.applicant.status.update');

    }); 

});

// public pages/routes for competition
// Route to display announce competition list
Route::get('public/poetry/competition/{id}', [PoetryAnnounceCompetitionController::class, 'show'])->name('poetry.competition.show');
Route::post('public/poetry/competition/apply', [PoetryAnnounceCompetitionController::class, 'apply'])->name('poetry.competition.apply');
