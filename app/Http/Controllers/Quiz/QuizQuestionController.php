<?php

namespace App\Http\Controllers\Quiz;

use Illuminate\Routing\Controller;
use App\Models\AgeCategory;
use App\Models\Competition;
use App\Models\Competitor;
use App\Models\CompetitionType;
use App\Models\CompetitionApplication;
use App\Models\ReadCategory;
use App\Models\Poetry;
use App\Models\SideCategory;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionAnswer;
use App\Models\CompetatorQuizAnswer;
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
        $competitionType = CompetitionType::where('name', 'Quiz')->first();
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
        
    
        
    
        // Update competition details
        
        $quiz_question->competition_id = $request->competition_id;
        $quiz_question->question_name = $request->question_name;
        $quiz_question->option_name = $request->option_name;
        $quiz_question->dead_line =date('Y-m-d',strtotime($request->dead_line));
        $quiz_question->url = $request->url;
        $quiz_question->encrypted_id = $request->encrypted_id;
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
        $competitionType = CompetitionType::where('name', 'Quiz')->first();   
        $question = QuizQuestion::with('questionAnswer')
        ->where('encrypted_id',$id)->firstOrFail();

        $competition = Competition::
        where('id',$question->competition_id)->firstOrFail();

        $moduleName = $competition->main_name;

        return view("client.quiz.question.show",compact('moduleName','question','competition'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $competitionType = CompetitionType::where('name', 'Quiz')->first();
        $moduleName = $this->module;
        $competition = Competition::findOrFail($id);
        $competitions = Competition::where('status','Pending')
        ->where('competition_type_id',$competitionType->id)
        ->get(); // Fetch competitions for logged-in user
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
        $competition = QuizQuestion::findOrFail($id);
        $competition->delete();
        QuizQuestionAnswer::where('question_id',$id)->delete();
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
            'competition_id' => 'required',
            
        ]);

        $quiz_answer = new CompetatorQuizAnswer();
        $quiz_answer->question_id = $request->question_id;
        $quiz_answer->answer_id = $request->answer_id;
        $quiz_answer->participant_name = $request->name;
        $quiz_answer->id_card = $request->id_card;
        $quiz_answer->phone_number = $request->number;
         
        $quiz_answer->save();


        // $competitor = new Competitor();
        // $competitor->name = $request->name;
        // $competitor->name_dhivehi = isset($request->name_Dhivehi) ? $request->name_Dhivehi : '';
        // $competitor->id_card = $request->id_card;
        // $competitor->permanent_address = $request->permanent_address;
        // $competitor->current_address = $request->current_address;
        // $competitor->city = $request->city;
        // $competitor->age = $request->age;
        // $competitor->dob = $request->dob;
        // $competitor->organization = $request->organization;
        // $competitor->save();
        

        return redirect()->back()->with('success', 'Answer submitted successfully!');

    }
}
