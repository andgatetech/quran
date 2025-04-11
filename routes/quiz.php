<?php
use App\Http\Controllers\ClientLoginController;
use App\Http\Controllers\Quiz\QuizCompetitionController;
use App\Http\Controllers\Quiz\QuizQuestionController;

use App\Http\Middleware\CheckSession;
use App\Http\Middleware\ClientAuthMiddleware;
use Illuminate\Support\Facades\Route;
// PDF view and Download Route
use App\Http\Controllers\PDFController;


Route::prefix('client')->middleware([ClientAuthMiddleware::class])->group(function () {
    // MENU
    Route::get('top/menu', [ClientLoginController::class, 'clientTopMenu'])->name('client.menu');
    Route::get('quiz/menu', function () {
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

        //QUESTION
        Route::get('question/create', [QuizQuestionController::class, 'create'])->name('quiz.question.create');
        Route::post('question/store', [QuizQuestionController::class, 'store'])->name('quiz.question.store');
        Route::get('question/list', [QuizQuestionController::class, 'index'])->name('quiz.question.list');
        Route::get('question/edit/{id}', [QuizQuestionController::class, 'edit'])->name('quiz.question.edit');
        Route::put('question/update/{id}', [QuizQuestionController::class, 'update'])->name('quiz.question.update');
        Route::delete('question/{id}',[QuizQuestionController::class, 'destroy'])->name('quiz.question.delete');



    });
});

