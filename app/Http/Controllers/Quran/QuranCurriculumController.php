<?php

namespace App\Http\Controllers\Quran;

use App\Models\CompetitionType;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\AgeCategory;
use App\Models\Competition;
use App\Models\ReadCategory;
use App\Models\SideCategory;
use App\Models\Curriculum;
use App\Models\Book;
use App\Models\CurriculumBook;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


class QuranCurriculumController extends Controller
{
    private $module = "Quran";
    private $competitionType;

    public function __construct(){
        // find competition type;
        $this->competitionType = CompetitionType::where('name', 'Quran')->first();
        View::share('moduleName', $this->module);
        // Use middleware to push action name on each request
        // $this->middleware(function ($request, $next) {
        //     $actionFull = class_basename(Route::currentRouteAction()); // e.g. QuranController@index
        //     $actionName = explode('@', $actionFull)[1] ?? '';
        //     View::share('actionName', $actionName);
        //     return $next($request);
        // });
    }
public function index()
{
    // Fetch curriculum data along with related models
    $curriculums = Curriculum::with([
        'competition',
        'sideCategory',
        'readCategory',
        'curriulumBook',
        'ageCategory'
    ])
    ->where('user_id', Auth::guard('client')->id())  // Filter by the currently authenticated user
    ->get();

    // Pass the data to the view
    return view('client.quran.curriculum.list', compact('curriculums'));
}


    public function create()
    {
        $books = Book::get();
        $competitions = Competition::where('user_id', Auth::guard('client')->id())->get();
        $sideCategories = SideCategory::where('user_id', Auth::guard('client')->id())->get();
        $readCategories = ReadCategory::where('user_id', Auth::guard('client')->id())->get();
        $ageCategories = AgeCategory::where('user_id', Auth::guard('client')->id())->get();

        return view('client.quran.curriculum.create', compact('books','competitions', 'sideCategories', 'readCategories', 'ageCategories'));
    }


    public function store(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'title' => 'required|string|max:255',
        //'number_of_questions' => 'nullable|integer',
        'total_ayah' => 'nullable|integer',
        'competition_id' => 'nullable|exists:competitions,id',
        'side_category_id' => 'nullable|exists:side_categories,id',
        'read_category_id' => 'nullable|exists:read_categories,id',
        'age_category_id' => 'nullable|exists:age_categories,id',
        'remarks' => 'nullable|string|max:1000',
    ]);

     $books=serialize($request->input('book'));

    $curriculum=new Curriculum();
    $curriculum->title=$request->title;
    $curriculum->book_id=$books;
    $curriculum->total_ayah=$request->total_ayah;
    $curriculum->competition_id=$request->competition_id;
    $curriculum->side_category_id=$request->side_category_id;
    $curriculum->read_category_id=$request->read_category_id;
    $curriculum->age_category_id=$request->age_category_id;
    $curriculum->remarks=$request->remarks;
    $curriculum->user_id=Auth::guard('client')->id();
    if($curriculum->save()){
        foreach($request->book as $key=>$value){
            $curriculum_book=new CurriculumBook();
            $curriculum_book->cu_id=$curriculum->id;
            $curriculum_book->book_id=$request->book[$key];
            $curriculum_book->save();
        }

    }

    // Redirect back to the form with a success message
    return redirect()->route('quran.curriculum.create')->with('success', 'Curriculum has been added successfully!');
}




public function edit($id)
{
    $books = Book::get();
    $curriculum = Curriculum::findOrFail($id);
    // Optionally load the related data if needed
    $competitions = Competition::where('user_id', Auth::guard('client')->id())->get();
    $sideCategories = SideCategory::where('user_id', Auth::guard('client')->id())->get();
    $readCategories = ReadCategory::where('user_id', Auth::guard('client')->id())->get();
    $ageCategories = AgeCategory::where('user_id', Auth::guard('client')->id())->get();

    return view('client.quran.curriculum.edit', compact('books','curriculum', 'competitions', 'sideCategories', 'readCategories', 'ageCategories'));
}



public function update(Request $request, $id)
{
    $curriculum = Curriculum::findOrFail($id);

    $curriculum_books = CurriculumBook::where('cu_id',$id)->get();

    // Validate the incoming request data
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        //'number_of_questions' => 'nullable|integer',
        'total_ayah' => 'nullable|integer',
        'competition_id' => 'nullable|exists:competitions,id',
        'side_category_id' => 'nullable|exists:side_categories,id',
        'read_category_id' => 'nullable|exists:read_categories,id',
        'age_category_id' => 'nullable|exists:age_categories,id',
        'remarks' => 'nullable|string|max:1000',
    ]);

    try {
        // Update the curriculum
        //$curriculum->update($validatedData);


        //$curriculum=Curriculum::find($id);
        $books=serialize($request->input('book'));
        $curriculum->title=$request->title;
        $curriculum->book_id=$books;
        $curriculum->total_ayah=$request->total_ayah;
        $curriculum->competition_id=$request->competition_id;
        $curriculum->side_category_id=$request->side_category_id;
        $curriculum->read_category_id=$request->read_category_id;
        $curriculum->age_category_id=$request->age_category_id;
        $curriculum->remarks=$request->remarks;
        //$curriculum->user_id=Auth::guard('client')->id();
        if($curriculum->save()){
            foreach($curriculum_books as $book){
                $curriculum_book = CurriculumBook::findOrFail($book->id);
                $curriculum_book->delete();
            }

            foreach($request->book as $key=>$value){
                $curriculum_book=new CurriculumBook();
                $curriculum_book->cu_id=$id;
                $curriculum_book->book_id=$request->book[$key];
                $curriculum_book->save();
            }

        }


        // Redirect back with success message
        return redirect()->route('quran.curriculum.list')->with('success', 'Curriculum updated successfully!');
    } catch (\Exception $e) {
        // Log the error
        \Log::error('Error updating curriculum: ' . $e->getMessage());

        // Redirect back with error message
        return redirect()->back()->with('error', 'Failed to update curriculum. Please try again.');
    }
}









public function destroy($id)
{
    // Find the curriculum by ID, or fail if it doesn't exist
    $curriculum = Curriculum::findOrFail($id);
    $curriculum_books = CurriculumBook::where('cu_id',$id)->get();

    try {
        // Delete the curriculum
        if($curriculum->delete()){
            foreach($curriculum_books as $book){
                $curriculum_book = CurriculumBook::findOrFail($book->id);
                $curriculum_book->delete();
            }
        }    

        // Redirect to the curriculum index page with a success message
        return redirect()->route('quran.curriculum.list')->with('success', 'Curriculum deleted successfully!');
    } catch (\Exception $e) {
        // Log any error that occurs during deletion
        \Log::error('Error deleting curriculum: ' . $e->getMessage());

        // Redirect to the curriculum index page with an error message
        return redirect()->route('quran.curriculum.list')->with('error', 'Failed to delete curriculum. Please try again.');
    }
}


}
