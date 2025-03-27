<?php

use App\Http\Controllers\ManageCompetitionController;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BellController;
use App\Http\Controllers\HostController;
use App\Http\Controllers\JudgeController;
use App\Http\Controllers\JudgesContoller;
use App\Http\Controllers\QuranController;
use App\Http\Controllers\NumberController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\CallingController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CompetitorController;
use App\Http\Controllers\AgeCategoryController;
use App\Http\Controllers\AnnounceCompetitionController;
use App\Http\Controllers\ClientLoginController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\AnnouncementController;

use App\Http\Controllers\HostAnnounceController;
use App\Http\Controllers\ReadCategoryController;
use App\Http\Controllers\SideCategoryController;
use App\Http\Controllers\PointCategoryController;
use App\Http\Controllers\RegistrationRequestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\ManageCertificateController;
use App\Models\Quran;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

Route::get('/api/get-ayahs/{bookNumber}', function ($bookNumber) {
    $ayahs = Quran::where('juz_no', $bookNumber)
        ->orderBy('ayah_no_juzz', 'asc')
        ->select('ayah_no_juzz')
        ->get();

    if ($ayahs->isEmpty()) {
        return response()->json(['success' => false, 'message' => 'No ayahs found for this book number.']);
    }

    return response()->json(['success' => true, 'ayahs' => $ayahs]);
});
// Route::get('/get-surahs', function (Request $request) {
//     $juzNo = $request->query('juz_no');

//     // Fetch distinct Surahs grouped by surah_no
//     $surahs = DB::table('the_quran_dataset')
//         ->select('surah_no', 'surah_name_ar', 'surah_name_roman')
//         ->where('juz_no', $juzNo)
//         ->groupBy('surah_no', 'surah_name_ar', 'surah_name_roman')
//         ->distinct()
//         ->get();

//     return response()->json($surahs);
// });





// Route::get('/get-surahs', function (Request $request) {
//     $juzNumbers = $request->query('juz_no'); // Expecting a comma-separated list of Juz numbers

//     // Convert to array if not already
//     $juzNumbersArray = explode(',', $juzNumbers);

//     // Fetch distinct Surahs grouped by surah_no
//     $surahs = DB::table('the_quran_dataset')
//         ->select('surah_no', 'surah_name_ar', 'surah_name_roman')
//         ->whereIn('juz_no', $juzNumbersArray) // Filter by multiple Juz numbers
//         ->groupBy('surah_no', 'surah_name_ar', 'surah_name_roman')
//         ->distinct()
//         ->get();

//     return response()->json($surahs);
// });















Route::get('/fetch-questions', [JudgesContoller::class, 'fetchQuestions'])->name('announcement.fetch-questions');
Route::get('/get-ayat/{book_number}', [QuestionController::class, 'getAyat']);


Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/users', [UserController::class, 'list'])->name('users.index');


Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::post('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');


Route::get('admin/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth');;

Route::post('/admin/login', [UserController::class, 'login'])->name('admin.login.submit');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/admin', [UserController::class, 'index'])->name('admin.index');
















// For announcing a competitor
Route::post('/announce/{competitor}', [RankingController::class, 'announce'])->name('competitor.announce');

// For rechecking (deleting the ranking record)
Route::post('/recheck/{competitor}', [RankingController::class, 'recheck'])->name('competitor.recheck');

Route::prefix('winning-announcement/')->group(function () {
    Route::get('index', [RankingController::class, 'index'])->name('winning.index');
    Route::get('login', [RankingController::class, 'login'])->name('winning.login');
    Route::post('login/submit', [RankingController::class, 'loginSubmit'])->name('winning.login.submit');
});

Route::get('winning-announcement/fetch-winners', [RankingController::class, 'fetchWinners'])->name('winning.fetch-winners');

Route::post('/rank/create/{competitor_id}', [RankingController::class, 'create'])->name('rank.create');


// Route for the form to input Juz number and verse range
Route::get('practice', function () {
    return view('practice');
})->name('quran.form');

// Route for fetching and displaying the verses
Route::get('quran/ayats', [QuranController::class, 'fetchAyats'])->name('quran.ayats');


Route::post('/results/store', [ResultController::class, 'storeResults'])->name('results.store');


Route::prefix('judges/')->group(function () {
    Route::get('index', [JudgesContoller::class, 'index'])->name('judges2.index');
    Route::get('login', [JudgesContoller::class, 'login'])->name('judges.login');
    Route::get('judgelogin', [JudgesContoller::class, 'judgelogin'])->name('judges.judgelogin');
    Route::post('login/submit', [JudgesContoller::class, 'loginSubmit'])->name('judges.login.submit');
    Route::post('login2/submit', [JudgesContoller::class, 'judgeloginsubmit'])->name('judges.login2.submit');

});




Route::prefix('number/')->group(function () {
    Route::get('index', [NumberController::class, 'index'])->name('number.index');
    Route::get('login', [NumberController::class, 'login'])->name('number.login');
    Route::post('login/submit', [NumberController::class, 'loginSubmit'])->name('number.login.submit');
    Route::post('/question/store', [NumberController::class, 'store'])->name('question.store');

});









Route::prefix('announcement/')->group(function () {
    Route::get('index', [AnnouncementController::class, 'index'])->name('announcement.index');
    Route::get('winners', [AnnouncementController::class, 'winners'])->name('announcement.winners');
    Route::get('/announcement/fetch-questions', [AnnouncementController::class, 'fetchQuestions'])->name('fetch-questions');
    Route::get('/ajax/winners', [AnnouncementController::class, 'getWinnersAjax'])->name('ajax.winners');

    Route::get('login', [AnnouncementController::class, 'login'])->name('announcement.login');
    Route::post('login/submit', [AnnouncementController::class, 'loginSubmit'])->name('announcement.login.submit');
});









Route::prefix('calling/')->group(function () {
    Route::get('/login', [CallingController::class, 'login'])->name('calling.login');
    Route::post('/login', [CallingController::class, 'loginSubmit'])->name('calling.login.submit');
    Route::get('/ready', [CallingController::class, 'ready'])->name('calling.ready');
    Route::get('/performed', [CallingController::class, 'performed'])->name('calling.performed');
    Route::get('/fetch-questions', [CallingController::class, 'fetchQuestions'])->name('questions.fetch');


    // In routes/web.php
Route::patch('/{competitor_id}/update-status', [CallingController::class, 'updateStatus'])->name('competitor.updateStatus');
// In routes/web.php
Route::patch('/{competitor_id}/revert-status', [CallingController::class, 'revertStatus'])->name('competitor.revertStatus');

});





































Route::post('/deactivate-bell', [BellController::class, 'deactivateBell'])->name('bell.deactivate');


Route::post('/bell/trigger', [BellController::class, 'triggerBell'])->name('bell.trigger');


Route::post('/get-active-bells', [BellController::class, 'getActiveBells'])->name('bell.getActiveBells');

Route::get('/announcement/bells', [BellController::class, 'getActiveBells'])->name('announcement.bells');
Route::get('/filter-bells', [BellController::class, 'filterPage'])->name('filter.bells');


Route::get('/', function () {
    return view('welcome');
})->name('welcome');;
// Route::get('/showquestion', function () {
//     return view('showquestion.showquestionuser');
// });

Route::get('/showquestion', [QuestionController::class, 'showQuestionPage'])->name('questions.show');
Route::get('/live-questionshost', [QuestionController::class, 'getLiveQuestions'])->name('questions.live');

Route::post('/show-question-to-user', [QuestionController::class, 'storeShownQuestion'])->name('show-question-to-user');



Route::get('/showquestionuser', [QuestionController::class, 'showQuestionPageuser'])->name('questions.show.user');
Route::get('/live-questions', [QuestionController::class, 'getLiveData'])->name('questions.live.data');

Route::get('/questions/next/{competition_id}', [QuestionController::class, 'getNextQuestion'])->name('questions.next.get');
Route::get('/loginhost', [QuestionController::class, 'login'])->name('showquestion.login');
Route::get('/loginuser', [QuestionController::class, 'loginuser'])->name('showquestion.user.login');
Route::post('/loginsubmit', [QuestionController::class, 'loginSubmit'])->name('showquestion.login.submit');
Route::post('/loginusersubmit', [QuestionController::class, 'loginSubmitUser'])->name('showquestion.login.user.submit');


Route::get('/questions/{competition_id}/next', [QuestionController::class, 'getNextQuestion']);
Route::post('/questions/{competition_id}/{question_id}/update-status', [QuestionController::class, 'updateQuestionStatus']);
// Route::get('/questions/{competition_id}', [QuestionController::class, 'getQuestions'])->name('questions.get');
Route::post('/questions/{competition_id}/next', [QuestionController::class, 'nextQuestion'])->name('questions.next');
// Route::post('/update-question-status/{competition_id}/{question_id}', [QuestionController::class, 'updateQuestionStatus']);
// Route::get('/questions/{competition_id}', [QuestionController::class, 'getQuestions']);
Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
Route::get('/questions/list', [QuestionController::class, 'list'])->name('questions.list');
Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
Route::post('/questions/bulk-upload', [QuestionController::class, 'bulkUpload'])->name('questions.bulkUpload');
Route::get('/test-files', function () {
    return app('files') ? 'Filesystem service is available' : 'Filesystem service not available';
});
Route::delete('/questions/{id}', [QuestionController::class, 'destroy'])->name('questions.delete');

Route::get('/check-curriculum', [QuestionController::class, 'checkCurriculum']);
Route::get('/get-curriculum/{id}', [QuestionController::class, 'getCurriculum']);

Route::get('/questions/{id}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
Route::put('/questions/{id}', [QuestionController::class, 'update'])->name('questions.update');
Route::get('/questions/{id}', [QuestionController::class, 'view'])->name('questions.view');








Route::resource('client/competitor', CompetitorController::class);

Route::prefix('client/competitor')->group(function () {
    Route::get('/create', [CompetitorController::class, 'create'])->name('competitors.create');
    Route::post('/post', [CompetitorController::class, 'store'])->name('competitors.store');
    Route::get('/', [CompetitorController::class, 'index'])->name('competitors.index');
    Route::get('/{id}/edit', [CompetitorController::class, 'edit'])->name('competitors.edit');
    Route::put('update/{id}', [CompetitorController::class, 'update'])->name('competitors.update');
    Route::delete('delete/{id}', [CompetitorController::class, 'destroy'])->name('competitors.destroy');
});





Route::resource('competitors', CompetitorController::class);

// New routes for bulk upload
Route::post('/competitors/bulk-store', [CompetitorController::class, 'bulkStore'])->name('competitors.bulkStore');














Route::resource('client/judge', JudgeController::class);

// Judge Routes
Route::prefix('client/judge')->group(function () {
    Route::get('/create', [JudgeController::class, 'create'])->name('judges.create');
    Route::post('/', [JudgeController::class, 'store'])->name('judges.store');
    Route::get('/', [JudgeController::class, 'index'])->name('judges.index');
    Route::get('/{id}/edit', [JudgeController::class, 'edit'])->name('judges.edit');
    Route::put('/{id}', [JudgeController::class, 'update'])->name('judges.update');
    Route::delete('/{id}', [JudgeController::class, 'destroy'])->name('judges.destroy');
});











// Sponsor Routes
Route::prefix('client/sponsor')->group(function () {
    Route::get('/create', [SponsorController::class, 'create'])->name('sponsors.create');
    Route::post('/', [SponsorController::class, 'store'])->name('sponsors.store');
    Route::get('/', [SponsorController::class, 'index'])->name('sponsors.index');
    Route::get('/{id}/edit', [SponsorController::class, 'edit'])->name('sponsors.edit');
    Route::put('/{id}', [SponsorController::class, 'update'])->name('sponsors.update');
    Route::delete('/{id}', [SponsorController::class, 'destroy'])->name('sponsors.destroy');
    Route::get('/{id}', [SponsorController::class, 'show'])->name('sponsors.show');
});







Route::prefix('client/host')->group(function () {
    Route::get('/create', [HostController::class, 'create'])->name('host.create');

    // Route for the competition list
    Route::get('/competition-list', [HostController::class, 'competitionList'])->name('competitions.list');

    // Route for announcing winners
    Route::get('/announce', [RankingController::class, 'announceWinners'])->name('host.announce');
    Route::post('/store', [HostController::class, 'store'])->name('host.store');
    Route::post('/{host}/continue', [HostController::class, 'continue'])->name('host.continue');

});























































// Login Routes
Route::get('/client/login', [ClientLoginController::class, 'showLoginForm'])->name('client.login');
Route::post('/client/login', [ClientLoginController::class, 'login'])->name('client.login.submit');

// Menu Page (Manual Authentication Check)
Route::get('/client/menu', function () {
    if (!Auth::check()) {
        // Redirect to login page if not authenticated
        return redirect()->route('client.login')->with('error', 'You must be logged in to access this page.');
    }
    // Display the menu page if authenticated
    return view('client.menu');
})->name('client.menu');

// Top Layer Menu  After Authentication
Route::get('/client/top/menu', function () {
    if (!Auth::check()) {
        // Redirect to login page if not authenticated
        return redirect()->route('client.login')->with('error', 'You must be logged in to access this page.');
    }
    //Display the menu page if authenticated
    return view('client.top-menu');
})->name('client.top-menu');


// Route to show the create competition form
Route::get('/client/competition/create', [CompetitionController::class, 'create'])->name('competition.create');

// Route to store competition data
Route::post('/client/competition/store', [CompetitionController::class, 'store'])->name('competition.store');


// Route to display competition list
Route::get('/client/competition/list', [CompetitionController::class, 'index'])->name('competition.list');

// Route to display announce competition list
Route::get('/compt/{id}', [AnnounceCompetitionController::class, 'show'])->name('competition.show');
Route::post('/apply', [AnnounceCompetitionController::class, 'apply'])->name('competition.apply');

Route::get('/client/competition/annouce', [AnnounceCompetitionController::class, 'create'])->name('competition.announce');
// Route::get('/client/annouce/list', [AnnounceCompetitionController::class, 'index'])->name('announce.list');
// Route::post('/client/annouce/store', [AnnounceCompetitionController::class, 'store'])->name('announce.store');
// Route::post('/client/annouce/delete/{id}', [AnnounceCompetitionController::class, 'destroy'])->name('announce.delete');
// Route::get('/client/annouce-list/edit/{id}', [AnnounceCompetitionController::class, 'edit'])->name('announce.edit');
// Route::post('/client/annouce-list/update', [AnnounceCompetitionController::class, 'update'])->name('announce.update');

Route::resource('announce-list', AnnounceCompetitionController::class)->except('destroy');
Route::get('delete-announce-competition/{id}',[AnnounceCompetitionController::class, 'destroy'])->name('delete-announce-competition');

Route::resource('registrations', RegistrationRequestController::class);
Route::post('update-application-status',[RegistrationRequestController::class , 'updateStatus'])->name('update-application-status');



// Route to edit a competition
Route::post('/client/competition/set-session', [CompetitionController::class, 'setSession'])->name('competition.setSession');
Route::get('/client/competition/edit', [CompetitionController::class, 'edit'])->name('competition.edit');
Route::post('/client/competition/update', [CompetitionController::class, 'update'])->name('competition.update');
Route::post('/client/competition/delete/{id}', [CompetitionController::class, 'destroy'])->name('competition.delete');


// Show create side category form
Route::get('/client/sidecategory/create', [SideCategoryController::class, 'create'])->name('sidecategory.create');

// Store side category data
Route::post('/client/sidecategory/store', [SideCategoryController::class, 'store'])->name('sidecategory.store');
Route::get('/client/sidecategory/list', [SideCategoryController::class, 'index'])->name('sidecategory.list');

// Set session for editing
Route::post('/client/sidecategory/set-session', [SideCategoryController::class, 'setSession'])->name('sidecategory.setSession');

// Show edit form
Route::get('/client/sidecategory/edit', [SideCategoryController::class, 'edit'])->name('sidecategory.edit');

// Update side category
Route::post('/client/sidecategory/update', [SideCategoryController::class, 'update'])->name('sidecategory.update');

// Delete side category
Route::post('/client/sidecategory/delete', [SideCategoryController::class, 'destroy'])->name('sidecategory.delete');


// Show create read category form
Route::get('/client/readcategory/create', [ReadCategoryController::class, 'create'])->name('readcategory.create');

// Store read category data
Route::post('/client/readcategory/store', [ReadCategoryController::class, 'store'])->name('readcategory.store');

// Show list of read categories
Route::get('/client/readcategory/list', [ReadCategoryController::class, 'index'])->name('readcategory.list');


// Set session for edit
Route::post('/client/readcategory/set-session', [ReadCategoryController::class, 'setSession'])->name('readcategory.setSession');

// Edit a read category
Route::get('/client/readcategory/edit', [ReadCategoryController::class, 'edit'])->name('readcategory.edit');

// Update a read category
Route::post('/client/readcategory/update', [ReadCategoryController::class, 'update'])->name('readcategory.update');

// Delete a read category
Route::post('/client/readcategory/delete', [ReadCategoryController::class, 'destroy'])->name('readcategory.delete');


// Create age category
Route::get('/client/agecategory/create', [AgeCategoryController::class, 'create'])->name('agecategory.create');
Route::post('/client/agecategory/store', [AgeCategoryController::class, 'store'])->name('agecategory.store');

// List age categories
Route::get('/client/agecategory/list', [AgeCategoryController::class, 'index'])->name('agecategory.index');

// Edit age category
Route::post('/client/agecategory/setSession', [AgeCategoryController::class, 'setSession'])->name('agecategory.setSession');
Route::get('/client/agecategory/edit', [AgeCategoryController::class, 'edit'])->name('agecategory.edit');

// Update Age Category
Route::post('/client/agecategory/update', [AgeCategoryController::class, 'update'])->name('agecategory.update');

// Delete Age Category
Route::post('/client/agecategory/delete/{id}', [AgeCategoryController::class, 'destroy'])->name('agecategory.delete');
Route::get('/client/pointcategory/create', [PointCategoryController::class, 'create'])->name('pointcategory.create');
Route::post('/client/pointcategory/store', [PointCategoryController::class, 'store'])->name('pointcategory.store');
Route::get('/client/pointcategory/list', [PointCategoryController::class, 'index'])->name('pointcategory.list');
// Set session for editing point category
Route::post('/client/pointcategory/set-session', [PointCategoryController::class, 'setSession'])->name('pointcategory.setSession');

// Edit point category (no ID in URL, session used)
Route::get('/client/pointcategory/edit', [PointCategoryController::class, 'edit'])->name('pointcategory.edit');

// Update point category
Route::post('/client/pointcategory/update', [PointCategoryController::class, 'update'])->name('pointcategory.update');

// Delete point category
Route::post('/client/pointcategory/delete', [PointCategoryController::class, 'destroy'])->name('pointcategory.delete');



// curriculum Crud

Route::prefix('client/curriculum')->group(function () {
    Route::get('/create', [CurriculumController::class, 'create'])->name('curriculum.create');
    Route::post('/post', [CurriculumController::class, 'store'])->name('curriculum.store');
    Route::get('/', [CurriculumController::class, 'index'])->name('curriculum.index');
    Route::get('/{id}/edit', [CurriculumController::class, 'edit'])->name('curriculum.edit');
    Route::put('update/{id}', [CurriculumController::class, 'update'])->name('curriculum.update');
    Route::delete('delete/{id}', [CurriculumController::class, 'destroy'])->name('curriculum.destroy');
});


// Manage Certificate

Route::prefix('client/managenertificate')->group(function () {
    Route::get('/create', [ManageCertificateController::class, 'create'])->name('managenertificate.create');
    Route::post('/post', [ManageCertificateController::class, 'store'])->name('managenertificate.store');
    Route::get('/', [ManageCertificateController::class, 'index'])->name('managenertificate.index');
    Route::get('/{id}/edit', [ManageCertificateController::class, 'edit'])->name('managenertificate.edit');
    Route::put('update/{id}', [ManageCertificateController::class, 'update'])->name('managenertificate.update');
    Route::delete('delete/{id}', [ManageCertificateController::class, 'destroy'])->name('managenertificate.destroy');
    Route::get('/generate-view', [ManageCertificateController::class, 'generateView'])->name('managenertificate.generate.view');
    Route::post('/generate-pdf', [ManageCertificateController::class, 'generatePDF'])->name('certificate.generate');
    // Route::post('/generate-certificate', [ManageCertificateController::class, 'certificate_generate'])
    //  ->name('certificate.generate');
    Route::get('/generated/list', [ManageCertificateController::class, 'generatedList'])->name('managenertificate.generated.list');
});

// Manage Competition
Route::prefix('client/manage/competition')->group(function () {
    Route::get('/magyplan', [ManageCompetitionController::class, 'mageyPlan'])->name('managecompitition.mageyPlan');
    Route::get('/how', [ManageCompetitionController::class, 'howManage'])->name('managecompitition.howManage');
});