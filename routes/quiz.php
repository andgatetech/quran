<?php
use App\Http\Controllers\ClientLoginController;
use App\Http\Controllers\Quiz\QuizCompetitionController;

use App\Http\Middleware\CheckSession;
use Illuminate\Support\Facades\Route;
// PDF view and Download Route
use App\Http\Controllers\PDFController;


Route::prefix('client')->group(function () {
    // MENU
    Route::get('top/menu', [ClientLoginController::class, 'clientTopMenu'])->name('client.menu');
    Route::get('quiz/menu', function () {
        if (!Auth::check()) {
            // Redirect to login page if not authenticated
            return redirect()->route('client.login')->with('error', 'You must be logged in to access this page.');
        }
        // Display the menu page if authenticated
        return view('client.menu.quiz-menu');
    })->name('client.menu.quiz');

    // QURAN MODULE
    Route::prefix('quiz')->group(function () {
        
        // COMPETITION
        Route::get('competition/create', [QuizCompetitionController::class, 'create'])->name('quiz.competition.create');
        Route::post('competition/store', [QuizCompetitionController::class, 'store'])->name('quiz.competition.store');
        Route::get('competition/list', [QuizCompetitionController::class, 'index'])->name('quiz.competition.list');
        // Route to edit a competition
        Route::get('competition/edit/{id}', [QuizCompetitionController::class, 'edit'])->name('quiz.competition.edit');
        Route::put('competition/update/{id}', [QuizCompetitionController::class, 'update'])->name('quiz.competition.update');
        Route::delete('competition/delete/{id}', [QuizCompetitionController::class, 'destroy'])->name('quiz.competition.delete');

     

});
});

