<?php

use App\Http\Controllers\ClientLoginController;
use App\Http\Controllers\Quran\QuranAgeCategoryController;
use App\Http\Controllers\Quran\QuranAnnounceCompetitionController;
use App\Http\Controllers\Quran\QuranCompetitionController;
use App\Http\Controllers\Quran\QuranRegistrationRequestController;
use App\Http\Controllers\Quran\RecitationPieceController;
use App\Http\Controllers\Quran\RecitationMethodController;
use App\Http\Middleware\CheckSession;
use Illuminate\Support\Facades\Route;
// PDF view and Download Route
use App\Http\Controllers\PDFController;



// Login Routes
Route::get('/client/login', [ClientLoginController::class, 'showLoginForm'])->name('client.login');
Route::post('/client/login', [ClientLoginController::class, 'login'])->name('client.login.submit');

Route::prefix('client')->group(function () {
    // MENU
    Route::get('top/menu', [ClientLoginController::class, 'clientTopMenu'])->name('client.menu');
    Route::get('quran/menu', function () {
        if (!Auth::check()) {
            // Redirect to login page if not authenticated
            return redirect()->route('client.login')->with('error', 'You must be logged in to access this page.');
        }
        // Display the menu page if authenticated
        return view('client.menu.quran-menu');
    })->name('client.menu.quran');

    // QURAN MODULE
    Route::prefix('quran')->group(function () {
        // COMPETITION ANNOUNCE
        Route::get('competition/announce/create', [QuranAnnounceCompetitionController::class, 'create'])->name('quran.competition.announce.create');
        Route::post('competition/announce/store', [QuranAnnounceCompetitionController::class, 'store'])->name('quran.competition.announce.store');
        Route::get('competition/announce/list', [QuranAnnounceCompetitionController::class, 'index'])->name('quran.competition.announce.list');
        Route::get('competition/announce/edit/{id}', [QuranAnnounceCompetitionController::class, 'edit'])->name('quran.competition.announce.edit');
        Route::put('competition/announce/update/{id}', [QuranAnnounceCompetitionController::class, 'update'])->name('quran.competition.announce.update');
        Route::delete('competition/announce/{id}',[QuranAnnounceCompetitionController::class, 'destroy'])->name('quran.competition.announce.delete');

        // COMPETITION
        Route::get('competition/create', [QuranCompetitionController::class, 'create'])->name('quran.competition.create');
        Route::post('competition/store', [QuranCompetitionController::class, 'store'])->name('quran.competition.store');
        Route::get('competition/list', [QuranCompetitionController::class, 'index'])->name('quran.competition.list');

        Route::get('competition/edit/{id}', [QuranCompetitionController::class, 'edit'])->name('quran.competition.edit');
        Route::put('competition/update/{id}', [QuranCompetitionController::class, 'update'])->name('quran.competition.update');
        Route::delete('competition/delete/{id}', [QuranCompetitionController::class, 'destroy'])->name('quran.competition.delete');

        // APPLICANTS WHO APPLIED TO PARTICIPATE
        Route::get('applicant/participate/registration', [QuranRegistrationRequestController::class,'index'])->name('quran.competition.applicant.list');
        Route::post('applicant/participate/status/update',[QuranRegistrationRequestController::class , 'updateStatus'])->name('quran.competition.applicant.status.update');

        // RECITATION PIECE
        Route::get('recitation/piece/create', [RecitationPieceController::class, 'create'])->name('quran.recitation.piece.create');
        Route::post('recitation/piece/store', [RecitationPieceController::class, 'store'])->name('quran.recitation.piece.store');
        Route::get('recitation/piece/list', [RecitationPieceController::class, 'index'])->name('quran.recitation.piece.list');

        Route::get('recitation/piece/edit/{id}', [RecitationPieceController::class, 'edit'])->name('quran.recitation.piece.edit');
        Route::put('recitation/piece/update/{id}', [RecitationPieceController::class, 'update'])->name('quran.recitation.piece.update');
        Route::delete('recitation/piece/delete/{id}', [RecitationPieceController::class, 'destroy'])->name('quran.recitation.piece.delete');

        // METHOD OF RECITATION
        Route::get('recitation/method/list', [RecitationMethodController::class, 'index'])->name('quran.recitation.method.list');
        Route::get('recitation/method/create', [RecitationMethodController::class, 'create'])->name('quran.recitation.method.create');
        Route::post('recitation/method/store', [RecitationMethodController::class, 'store'])->name('quran.recitation.method.store');

        Route::get('recitation/method/edit/{id}', [RecitationMethodController::class, 'edit'])->name('quran.recitation.method.edit');
        Route::put('recitation/method/update/{id}', [RecitationMethodController::class, 'update'])->name('quran.recitation.method.update');
        Route::delete('recitation/method/delete/{id}', [RecitationMethodController::class, 'destroy'])->name('quran.recitation.method.delete');

        // AGE CATEGORY
        Route::get('agecategory/create', [QuranAgeCategoryController::class, 'create'])->name('quran.agecategory.create');
        Route::post('agecategory/store', [QuranAgeCategoryController::class, 'store'])->name('quran.agecategory.store');
        Route::get('agecategory/list', [QuranAgeCategoryController::class, 'index'])->name('quran.agecategory.index');

        Route::get('agecategory/edit/{id}', [QuranAgeCategoryController::class, 'edit'])->name('quran.agecategory.edit');
        Route::put('agecategory/update/{id}', [QuranAgeCategoryController::class, 'update'])->name('quran.agecategory.update');
        Route::delete('agecategory/delete/{id}', [QuranAgeCategoryController::class, 'destroy'])->name('quran.agecategory.delete');

    }); 

});

// public pages/routes for competition
// Route to display announce competition list
Route::get('public/competition/{id}', [QuranAnnounceCompetitionController::class, 'show'])->name('quran.competition.show');
Route::post('public/competition/apply', [QuranAnnounceCompetitionController::class, 'apply'])->name('quran.competition.apply');



Route::get('/pdf/view/{path}', [PDFController::class, 'view'])->name('pdf.view');
Route::get('/pdf/download/{path}', [PDFController::class, 'download'])->name('pdf.download');




// Top Layer Menu  After Authentication
Route::get('/client/top/menu', [ClientLoginController::class, 'clientTopMenu'])->name('client.menu');

// Menu Page (Manual Authentication Check)
Route::get('/client/quran/menu', function () {
    if (!Auth::check()) {
        // Redirect to login page if not authenticated
        return redirect()->route('client.login')->with('error', 'You must be logged in to access this page.');
    }
    // Display the menu page if authenticated
    return view('client.menu.quran-menu');
})->name('client.menu.quran');





Route::middleware('auth')->group(function () {
    Route::get('/department', function () {
        return 'Here test route of department';
    });
    Route::get('/department/{id}', function ($id) {
        return "Department details for ID: $id";
    });
});
// route test : need to remove later



