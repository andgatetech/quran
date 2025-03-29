<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\poetry\AnnounceCompetitionController;

Route::get('/poems', function () {
    return 'List of poems';
});

Route::get('/poems/{id}', function ($id) {
    return "Poem details for ID: $id";
});


Route::get('competition/annouce', [AnnounceCompetitionController::class, 'create'])->name('poetry.competition.announce');
Route::resource('announce-list', AnnounceCompetitionController::class)->except('destroy');

// Poetry routes
Route::prefix('client/poetry')->group(function () {
    // Route to display announce competition list
    Route::get('/compt/{id}', [AnnounceCompetitionController::class, 'show'])->name('poetry.competition.show');
    Route::post('/apply', [AnnounceCompetitionController::class, 'apply'])->name('poetry.competition.apply');

    Route::get('/competition/annouce', [AnnounceCompetitionController::class, 'create'])->name('poetry.competition.announce');
    // Route::get('/client/annouce/list', [AnnounceCompetitionController::class, 'index'])->name('announce.list');
    // Route::post('/client/annouce/store', [AnnounceCompetitionController::class, 'store'])->name('announce.store');
    // Route::post('/client/annouce/delete/{id}', [AnnounceCompetitionController::class, 'destroy'])->name('announce.delete');
    // Route::get('/client/annouce-list/edit/{id}', [AnnounceCompetitionController::class, 'edit'])->name('announce.edit');
    // Route::post('/client/annouce-list/update', [AnnounceCompetitionController::class, 'update'])->name('announce.update');

    Route::resource('announce-list', AnnounceCompetitionController::class)->except('destroy');
    Route::get('delete-announce-competition/{id}',[AnnounceCompetitionController::class, 'destroy'])->name('poetry.delete-announce-competition');
});
