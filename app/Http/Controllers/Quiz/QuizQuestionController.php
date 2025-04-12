<?php

namespace App\Http\Controllers\Quiz;

use Illuminate\Routing\Controller;
use App\Models\AgeCategory;
use App\Models\Competition;
use App\Models\CompetitionType;
use App\Models\CompetitionApplication;
use App\Models\ReadCategory;
use App\Models\Poetry;
use App\Models\SideCategory;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionAnswer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuizQuestionController extends Controller
{
    private $module = "Quiz";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $moduleName = $this->module;
        $competitionType = CompetitionType::where('name', 'Quiz')->first();
        $competitions = Competition::
        where('competition_type_id',$competitionType->id)
        ->orderBy('updated_at','desc')->get(); // Fetch competitions for logged-in user
        // dd($competitions);

        $quiz_questions=QuizQuestion::with('questionAnswer')
        ->get();
        return view('client.quiz.question.list',compact('quiz_questions','competitions', 'moduleName')); // Path to your Blade file

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $moduleName = $this->module;
        $competitionType = CompetitionType::where('name', 'Poetry')->first();
        $competitions = Competition::where('status','Pending')
        ->where('competition_type_id',$competitionType->id)
        ->get(); // Fetch competitions for logged-in user
        return view('client.quiz.question.create',compact('competitions', 'moduleName')); // Path to your Blade file
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'competition_id' => 'required',
            'dead_line' => 'required|date',
            'url' => 'required|url',
            
        ]);
 
        // Find the competition

        $quiz_question=new QuizQuestion();
        $competition = Competition::findOrFail($request->competition_id);
    
        
    
        // Update competition details
        
        $quiz_question->competition_id = $request->competition_id;
        $quiz_question->question_name = $request->question_name;
        $quiz_question->option_name = $request->option_name;
        $quiz_question->dead_line =date('Y-m-d',strtotime($request->dead_line));
        $quiz_question->url = $request->url;
        $quiz_question->user_id =Auth::guard('client')->id();
        
        $quiz_question->save();

        if($quiz_question->option_name=="Multiple"){
            foreach($request->answer_name as $key=>$value){
                $question_answer=new QuizQuestionAnswer();
                $question_answer->question_id=$quiz_question->id;
                $question_answer->answer_name=$value;
                $question_answer->save();
            }
        }
    
        return redirect()->route('quiz.question.list')->with('success', 'Competition announced successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $moduleName = $this->module;
        $competitionType = CompetitionType::where('name', 'Poetry')->first();
        
        $competition = Competition::where('encrypted_id',$id)->firstOrFail();
        $age_categories = AgeCategory::
        where('competition_type_id',$competitionType->id)
        ->get();
        $read_categories = ReadCategory::
        where('competition_type_id',$competitionType->id)
        ->get();
        $side_categories = SideCategory::
        where('competition_type_id',$competitionType->id)
        ->get();

        $poetries = Poetry::
        where('competition_id',$competition->id)
        ->get();

        $moduleName = $competition->main_name;

        return view("client.quiz.question.show",compact('moduleName','poetries','competition','side_categories','read_categories','age_categories'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $moduleName = $this->module;
        $competition = Competition::findOrFail($id);
        $competitions = Competition::where('status','Pending')->get(); // Fetch competitions for logged-in user
        return view('client.quiz.question.edit',compact('moduleName','competitions','competition')); // Path to your Blade file
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $competitionId = $request->competition_id;
        $request->validate([
            'competition_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'no_of_days' => 'required',
            'url' => 'required'
        ]);
        $competition = Competition::findOrFail($competitionId);
        $competition->start_date = $request->start_date;
        $competition->end_date = $request->end_date;
        $competition->no_of_days = $request->no_of_days;
        $competition->url = $request->url;
        $competition->save();
        return redirect()->route('quiz.question.list')->with('success', 'Data Updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $competition = Competition::findOrFail($id);
        $competition->delete();
        return redirect()->route('quiz.question.list')->with('success', 'Competition deleted successfully!');

    }
    public function apply(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'id_card' => 'required',
            'permanent_address' => 'required',
            'current_address' => 'required',
            'city' => 'required',
            'dob' => 'required',
            'age' => 'required',
            'organization' => 'required',
            'number' => 'required',
            'age_category' => 'required',
            'side_category' => 'required',
            'read_category' => 'required',
            'competition_id' => 'required',
            'poetry_id' => 'required',
            'photo' => 'required|mimes:jpg,jpeg,png|max:2048', // 2MB max
            'id_card_photo' => 'required|mimes:jpg,jpeg,png,pdf|max:2048', // 2MB max
        ]);
        $application = new CompetitionApplication();
        $application->competition_id = $request->competition_id;
        $application->name = $request->name;
        $application->name_dhivehi = isset($request->name_Dhivehi) ? $request->name_Dhivehi : '';
        $application->id_card = $request->id_card;
        $application->permanent_address = $request->permanent_address;
        $application->current_address = $request->current_address;
        $application->city = $request->city;
        $application->age = $request->age;
        $application->dob = $request->dob;
        $application->organization = $request->organization;
        $application->number = $request->number;
        $application->age_category = $request->age_category;
        $application->side_category = $request->side_category;
        $application->read_category = $request->read_category;
        $application->poetry_id = $request->poetry_id;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->move(public_path('assets/img'), $request->file('photo')->getClientOriginalName());
            $application->photo = 'assets/img/' . $request->file('photo')->getClientOriginalName();
        }

        // Save the 'id_card_photo' file
        if ($request->hasFile('id_card_photo')) {
            $idCardPath = $request->file('id_card_photo')->move(public_path('assets/img'), $request->file('id_card_photo')->getClientOriginalName());
            $application->id_card_photo = 'assets/img/' . $request->file('id_card_photo')->getClientOriginalName();
        }
        $application->save();
        return redirect()->back()->with('success', 'Application submitted successfully!');

    }
}
