<?php

use App\Http\Controllers\ClientLoginController;
use App\Http\Controllers\Quran\QuranAnnounceCompetitionController;
use App\Http\Middleware\CheckSession;
use Illuminate\Support\Facades\Route;



// Login Routes
Route::get('/client/login', [ClientLoginController::class, 'showLoginForm'])->name('client.login');
Route::post('/client/login', [ClientLoginController::class, 'login'])->name('client.login.submit');

Route::prefix('client')->group(function () {
    Route::get('top/menu', [ClientLoginController::class, 'clientTopMenu'])->name('client.menu');
    Route::get('quran/menu', function () {
        if (!Auth::check()) {
            // Redirect to login page if not authenticated
            return redirect()->route('client.login')->with('error', 'You must be logged in to access this page.');
        }
        // Display the menu page if authenticated
        return view('client.menu.quran-menu');
    })->name('client.menu.quran');


    Route::prefix('quran')->group(function () {
        Route::get('competition/announce/create', [QuranAnnounceCompetitionController::class, 'create'])->name('quran.competition.announce.create');
        Route::post('competition/announce/store', [QuranAnnounceCompetitionController::class, 'store'])->name('quran.competition.announce.store');
        Route::get('competition/announce/list', [QuranAnnounceCompetitionController::class, 'index'])->name('quran.competition.announce.list');
        Route::get('competition/announce/edit/{id}', [QuranAnnounceCompetitionController::class, 'edit'])->name('quran.competition.announce.edit');
        Route::put('competition/announce/update/{id}', [QuranAnnounceCompetitionController::class, 'update'])->name('quran.competition.announce.update');
        Route::delete('competition/announce/{id}',[QuranAnnounceCompetitionController::class, 'destroy'])->name('quran.competition.announce.delete');
        // Route::resource('announce-list', QuranAnnounceCompetitionController::class)->except('destroy');
    });

    

});

// PDF view and Download Route
use App\Http\Controllers\PDFController;

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



