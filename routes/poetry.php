<?php
use App\Http\Controllers\ClientLoginController;
use App\Http\Controllers\Poetry\PoetryAnnounceCompetitionController;
use App\Http\Controllers\Poetry\PoetryCompetitionController;
use App\Http\Controllers\Poetry\PoetryRegistrationRequestController;
use App\Http\Controllers\Poetry\PoetrySideCategoryController;
use App\Http\Controllers\Poetry\PoetryReadCategoryController;
use App\Http\Controllers\Poetry\PoetryAgeCategoryController;
use App\Http\Controllers\Poetry\PoetryPointCategoryController;
use App\Http\Controllers\Poetry\PoetryJudgeController;
use App\Http\Controllers\Poetry\PoetryCompetitorController;
use App\Http\Controllers\Poetry\PoetrySponsorController;
use App\Http\Controllers\Poetry\PoetryHostController;
use App\Http\Controllers\Poetry\PoetryRankingController;
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

        // APPLICANTS WHO APPLIED TO PARTICIPATE
        Route::get('applicant/participate/registration', [PoetryRegistrationRequestController::class,'index'])->name('poetry.competition.applicant.list');
        Route::post('applicant/participate/status/update',[PoetryRegistrationRequestController::class , 'updateStatus'])->name('poetry.competition.applicant.status.update');

        // COMPETITION
        Route::get('competition/create', [PoetryCompetitionController::class, 'create'])->name('poetry.competition.create');
        Route::post('competition/store', [PoetryCompetitionController::class, 'store'])->name('poetry.competition.store');
        Route::get('competition/list', [PoetryCompetitionController::class, 'index'])->name('poetry.competition.list');
        // Route to edit a competition
        Route::get('competition/edit/{id}', [PoetryCompetitionController::class, 'edit'])->name('poetry.competition.edit');
        Route::put('competition/update/{id}', [PoetryCompetitionController::class, 'update'])->name('poetry.competition.update');
        Route::delete('competition/delete/{id}', [PoetryCompetitionController::class, 'destroy'])->name('poetry.competition.delete');

        //RECITATION PIECE
        // Show create side category form
        Route::get('/sidecategory/create', [PoetrySideCategoryController::class, 'create'])->name('poetry.sidecategory.create');
        // Store side category data
        Route::post('/sidecategory/store', [PoetrySideCategoryController::class, 'store'])->name('poetry.sidecategory.store');
        Route::get('/sidecategory/list', [PoetrySideCategoryController::class, 'index'])->name('poetry.sidecategory.list');
        // Set session for editing
        Route::post('/sidecategory/set-session', [PoetrySideCategoryController::class, 'setSession'])->name('poetry.sidecategory.setSession');
        // Show edit form
        Route::get('/sidecategory/edit', [PoetrySideCategoryController::class, 'edit'])->name('poetry.sidecategory.edit');
        // Update side category
        Route::post('/sidecategory/update', [PoetrySideCategoryController::class, 'update'])->name('poetry.sidecategory.update');
        // Delete side category
        Route::post('/sidecategory/delete', [PoetrySideCategoryController::class, 'destroy'])->name('poetry.sidecategory.delete');

        // METHOD OF RECITATION
        // Show create read category form
        Route::get('/readcategory/create', [PoetryReadCategoryController::class, 'create'])->name('poetry.readcategory.create');
        // Store read category data
        Route::post('/readcategory/store', [PoetryReadCategoryController::class, 'store'])->name('poetry.readcategory.store');
        // Show list of read categories
        Route::get('/readcategory/list', [PoetryReadCategoryController::class, 'index'])->name('poetry.readcategory.list');
        // Set session for edit
        Route::post('/readcategory/set-session', [PoetryReadCategoryController::class, 'setSession'])->name('poetry.readcategory.setSession');
        // Edit a read category
        Route::get('/readcategory/edit', [PoetryReadCategoryController::class, 'edit'])->name('poetry.readcategory.edit');
        // Update a read category
        Route::post('/readcategory/update', [PoetryReadCategoryController::class, 'update'])->name('poetry.readcategory.update');
        // Delete a read category
        Route::post('/readcategory/delete', [PoetryReadCategoryController::class, 'destroy'])->name('poetry.readcategory.delete');

        // AGE CATEGORY
        // Create age category
        Route::get('/agecategory/create', [PoetryAgeCategoryController::class, 'create'])->name('poetry.agecategory.create');
        Route::post('/agecategory/store', [PoetryAgeCategoryController::class, 'store'])->name('poetry.agecategory.store');
        // List age categories
        Route::get('/agecategory/list', [PoetryAgeCategoryController::class, 'index'])->name('poetry.agecategory.index');
        // Edit age category
        Route::post('/agecategory/setSession', [PoetryAgeCategoryController::class, 'setSession'])->name('poetry.agecategory.setSession');
        Route::get('/agecategory/edit', [PoetryAgeCategoryController::class, 'edit'])->name('poetry.agecategory.edit');
        // Update Age Category
        Route::post('/agecategory/update', [PoetryAgeCategoryController::class, 'update'])->name('poetry.agecategory.update');
        // Delete Age Category
        Route::post('/agecategory/delete/{id}', [PoetryAgeCategoryController::class, 'destroy'])->name('poetry.agecategory.delete');

        // POINT CATEGORY
        Route::get('/pointcategory/create', [PoetryPointCategoryController::class, 'create'])->name('poetry.pointcategory.create');
        Route::post('/pointcategory/store', [PoetryPointCategoryController::class, 'store'])->name('poetry.pointcategory.store');
        Route::get('/pointcategory/list', [PoetryPointCategoryController::class, 'index'])->name('poetry.pointcategory.list');
        // Set session for editing point category
        Route::post('/pointcategory/set-session', [PoetryPointCategoryController::class, 'setSession'])->name('poetry.pointcategory.setSession');
        // Edit point category (no ID in URL, session used)
        Route::get('/pointcategory/edit', [PoetryPointCategoryController::class, 'edit'])->name('poetry.pointcategory.edit');        
        // Update point category
        Route::post('/pointcategory/update', [PoetryPointCategoryController::class, 'update'])->name('poetry.pointcategory.update');        
        // Delete point category
        Route::post('/pointcategory/delete', [PoetryPointCategoryController::class, 'destroy'])->name('poetry.pointcategory.delete');
         
        // JUDGE
        Route::get('/judge/create', [PoetryJudgeController::class, 'create'])->name('poetry.judges.create');
        Route::post('/judge/store', [PoetryJudgeController::class, 'store'])->name('poetry.judges.store');
        Route::get('/judge/list', [PoetryJudgeController::class, 'index'])->name('poetry.judges.index');
        Route::get('judge//{id}/edit', [PoetryJudgeController::class, 'edit'])->name('poetry.judges.edit');
        Route::put('/{id}', [PoetryJudgeController::class, 'update'])->name('poetry.judges.update');
        Route::delete('/{id}', [PoetryJudgeController::class, 'destroy'])->name('poetry.judges.destroy');


        // COMPETITATOR
        Route::post('/competitors/bulk-store', [PoetryCompetitorController::class, 'bulkStore'])->name('poetry.competitors.bulkStore');
        Route::get('/competitator/create', [PoetryCompetitorController::class, 'create'])->name('poetry.competitors.create');
        Route::post('/competitator/post', [PoetryCompetitorController::class, 'store'])->name('poetry.competitors.store');
        Route::get('/competitator/list', [PoetryCompetitorController::class, 'index'])->name('poetry.competitors.index');
        Route::get('/competitator/{id}/edit', [PoetryCompetitorController::class, 'edit'])->name('poetry.competitors.edit');
        Route::put('/competitator/update/{id}', [PoetryCompetitorController::class, 'update'])->name('poetry.competitors.update');
        Route::delete('/competitator/delete/{id}', [PoetryCompetitorController::class, 'destroy'])->name('poetry.competitors.destroy');
        
        // SPONSOR
        Route::get('/sponsor/create', [PoetrySponsorController::class, 'create'])->name('poetry.sponsors.create');
        Route::post('/sponsor/store', [PoetrySponsorController::class, 'store'])->name('poetry.sponsors.store');
        Route::get('/sponsor/list', [PoetrySponsorController::class, 'index'])->name('poetry.sponsors.index');
        Route::get('/sponsor/{id}/edit', [PoetrySponsorController::class, 'edit'])->name('poetry.sponsors.edit');
        Route::put('/sponsor/update/{id}', [PoetrySponsorController::class, 'update'])->name('poetry.sponsors.update');
        Route::delete('/sponsor/delete/{id}', [PoetrySponsorController::class, 'destroy'])->name('poetry.sponsors.destroy');
        Route::get('/sponsor/show/{id}', [PoetrySponsorController::class, 'show'])->name('poetry.sponsors.show');

        // TO START COMPETITION
        Route::get('/host/create', [PoetryHostController::class, 'create'])->name('poetry.host.create');
        Route::get('/host/competition-list', [PoetryHostController::class, 'competitionList'])->name('poetry.competitions.list');
        Route::get('/rank/announce', [PoetryRankingController::class, 'announceWinners'])->name('poetry.host.announce');
        Route::post('/host/store', [PoetryHostController::class, 'store'])->name('poetry.host.store');
        Route::post('/host/{host}/continue', [PoetryHostController::class, 'continue'])->name('poetry.host.continue');

        // FOR ANNOUNCING  A COMPETITOR
        Route::post('/announce/{competitor}', [PoetryRankingController::class, 'announce'])->name('poetry.competitor.announce');
        Route::post('/recheck/{competitor}', [PoetryRankingController::class, 'recheck'])->name('poetry.competitor.recheck');
        Route::prefix('winning-announcement/')->group(function () {
            Route::get('index', [PoetryRankingController::class, 'index'])->name('poetry.winning.index');
            Route::get('login', [PoetryRankingController::class, 'login'])->name('poetry.winning.login');
            Route::post('login/submit', [PoetryRankingController::class, 'loginSubmit'])->name('poetry.winning.login.submit');
        });
        Route::get('winning-announcement/fetch-winners',[PoetryRankingController::class, 'fetchWinners'])->name('poetry.winning.fetch-winners');
        Route::post('/rank/create/{competitor_id}',[PoetryRankingController::class, 'create'])->name('poetry.rank.create');
    }); 

});

// public pages/routes for competition
// Route to display announce competition list
Route::get('public/poetry/competition/{id}', [PoetryAnnounceCompetitionController::class, 'show'])->name('poetry.competition.show');
Route::post('public/poetry/competition/apply', [PoetryAnnounceCompetitionController::class, 'apply'])->name('poetry.competition.apply');