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


