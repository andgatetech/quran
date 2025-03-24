<?php

namespace App\Http\Controllers;
use App\Models\Host;
use App\Models\Judge;
use App\Models\Quran;
use App\Models\Question;
use App\Models\Competitor;
use App\Models\AgeCategory;
use App\Models\Competition;
use App\Models\ReadCategory;
use App\Models\SideCategory;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;
use App\Models\QuestionChild;
use App\Models\ShowUserQuestion;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Log;

// use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http; // For HTTP API requests

class QuestionController extends Controller
{



    public function getLiveData()
    {
        $competitionId = session('competition_id');
        // $competitorId = session('competitor_id');
        $questions = \DB::table('show_user_questions as q')
        ->join('competitors as c', 'q.competitor_id', '=', 'c.id')
        ->join('questions as qs', 'qs.id', '=', 'q.question_id') // Join questions table
        ->where('c.status', 'ongoing')
        ->whereColumn('q.competition_id', 'c.competition_id')
        ->where('q.competition_id', $competitionId)
        ->select(
            '*',
            'c.full_name as competitor_name',
            'q.text as text'
             // Select question_name from questions table
        )
        ->get();

        return response()->json($questions);
    }









    public function create()
    {
        $competitions = Competition::where('user_id', Auth::id())->get();
        $sideCategories = SideCategory::where('user_id', Auth::id())->get();
        $readCategories = ReadCategory::where('user_id', Auth::id())->get();
        $ageCategories = AgeCategory::where('user_id', Auth::id())->get();
        $quran = Quran::select('surah_no', 'surah_name_ar', 'surah_name_roman')
        ->groupBy('surah_no', 'surah_name_ar', 'surah_name_roman')
        ->orderBy('surah_no', 'asc')
        ->get();


        return view('client.questions.create', compact('competitions', 'sideCategories', 'readCategories', 'ageCategories','quran'));
    }



    public function list()
    {
        $competitions = Competition::where('user_id', Auth::id())->get();
        $sideCategories = SideCategory::where('user_id', Auth::id())->get();
        $readCategories = ReadCategory::where('user_id', Auth::id())->get();
        $ageCategories = AgeCategory::where('user_id', Auth::id())->get();
        $questions = Question::where('user_id', Auth::id())->get();
        $quran = Quran::select('surah_no', 'surah_name_ar', 'surah_name_roman')
        ->groupBy('surah_no', 'surah_name_ar', 'surah_name_roman')
        ->orderBy('surah_no', 'asc')
        ->get();
        return view('client.questions.list', compact('questions','competitions', 'sideCategories', 'readCategories', 'ageCategories','quran'));

    }






    public function edit($id)
    {
        $competitions = Competition::where('user_id', Auth::id())->get();
        $sideCategories = SideCategory::where('user_id', Auth::id())->get();
        $readCategories = ReadCategory::where('user_id', Auth::id())->get();
        $ageCategories = AgeCategory::where('user_id', Auth::id())->get();
        $quran = Quran::select('surah_no', 'surah_name_ar', 'surah_name_roman')
            ->groupBy('surah_no', 'surah_name_ar', 'surah_name_roman')
            ->orderBy('surah_no', 'asc')
            ->get();

        $question = Question::findOrFail($id);

        return view('client.questions.edit', compact('question', 'competitions', 'sideCategories', 'readCategories', 'ageCategories', 'quran'));
    }







    public function showQuestionPage()
    {
        $competition_id = session('competition_id');
$competition=Competition::where('id',$competition_id)->first();
$Judge=Judge::where('competition_id',$competition_id)->get();
        // Fetch questions for ongoing competitors
        $questions = QuestionChild::join('questions', 'questions.id', '=', 'question_child.question_id')
            ->join('competitors', 'competitors.id', '=', 'question_child.competitor_id')
            ->where('competitors.status', 'ongoing')
            ->where('questions.competition_id', $competition_id)
            ->select(
                '*',
                'questions.id as question_id',

                'competitors.id as competitor_id',
                'competitors.full_name as competitor_name'
            )
            ->get();

        foreach ($questions as $question) {
            $question->ayat_details = Quran::where('juz_no', $question->book_number)
                ->whereBetween('ayah_no_juzz', [$question->from_ayat_number, $question->to_ayat_number])
                ->get();
        }

        return view('showquestion.showquestionadmin', compact('questions','competition','Judge'));
    }

    public function getLiveQuestions()
    {
        $competition_id = session('competition_id');

        // Fetch questions for ongoing competitors
        $questions = QuestionChild::join('questions', 'questions.id', '=', 'question_child.question_id')
            ->join('competitors', 'competitors.id', '=', 'question_child.competitor_id')
            ->where('competitors.status', 'ongoing')
            ->where('questions.competition_id', $competition_id)
            ->select(
                '*',
                'questions.id as question_id',

                'competitors.id as competitor_id',
                'competitors.full_name as competitor_name'
            )
            ->get();

        foreach ($questions as $question) {
            $question->ayat_details = Quran::where('juz_no', $question->book_number)
                ->whereBetween('ayah_no_juzz', [$question->from_ayat_number, $question->to_ayat_number])
                ->get();
        }

        return response()->json($questions);
    }





    public function storeShownQuestion(Request $request)
    {
        $validatedData = $request->validate([
            'question_id'    => 'required|integer',
            'competition_id' => 'required|integer',
            'competitor_id'  => 'required|integer',
            'text'           => 'required|string',
        ]);

        try {
            // Check if a record already exists
            $existingRecord = ShowUserQuestion::where('competition_id', $validatedData['competition_id'])
                ->where('competitor_id', $validatedData['competitor_id'])
                ->first();

            if ($existingRecord) {
                // Update the existing record
                $existingRecord->update([
                    'question_id' => $validatedData['question_id'],
                    'text'        => $validatedData['text'],
                ]);

                return response()->json(['success' => true, 'message' => 'Record updated successfully.']);
            } else {
                // Create a new record
                ShowUserQuestion::create([
                    'question_id'    => $validatedData['question_id'],
                    'competition_id' => $validatedData['competition_id'],
                    'competitor_id'  => $validatedData['competitor_id'],
                    'text'           => $validatedData['text'],
                    'status'         => 'shown',
                ]);

                return response()->json(['success' => true, 'message' => 'New record created successfully.']);
            }
        } catch (\Exception $e) {
            Log::error('Error storing shown question: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while processing the request.'], 500);
        }
    }











public function showQuestionPageuser()
{
    $competition_id = session('competition_id');
    $competition=Competition::where('id',$competition_id)->first();
    $Judge=Judge::where('competition_id',$competition_id)->get();
    // Query the show_user_question table joined with competitors
    $questions = \DB::table('show_user_questions as q')
    ->join('competitors as c', 'q.competitor_id', '=', 'c.id')
    ->join('questions as qs', 'qs.id', '=', 'q.question_id') // Join questions table
    ->where('c.status', 'ongoing')
    ->whereColumn('q.competition_id', 'c.competition_id')
    ->where('q.competition_id', $competition_id)
    ->select(
        'q.*',
        'c.full_name as competitor_name',
        'qs.question_name' // Select question_name from questions table
    )
    ->get();


    return view('showcompitatorscreen.showquestionuser', compact('questions','competition','Judge'));
}



    // Fetch the next active question for the competition
    public function getNextQuestion($competition_id)
{
    // Fetch competitors who are ongoing
    $competitors = Competitor::where('status', 'ongoing')->pluck('id');

    // Fetch the first active question based on competition and competitor status
    $question = DB::table('questions')
        ->join('question_child as qc', 'qc.question_id', '=', 'questions.id')
        ->where('qc.competition_id', $competition_id)
        ->whereIn('qc.competitor_id', $competitors) // Ensure only relevant competitors are included
        ->where('qc.status', 'active') // Only fetch active questions
        ->select('questions.id', 'questions.question_name', 'questions.hardness')
        ->first();

    // Return the question as JSON response
    return response()->json($question);
}

public function login()
{
    return view('showquestion.login');
}
public function loginuser()
{
    return view('showcompitatorscreen.login');
}

public function loginSubmit(Request $request)
{
    // Validate the input data
    $request->validate([
        'host_id' => 'required|string',
        'password' => 'required|string',
    ]);

    // Attempt to find the host by host_id
    $host = Host::where('host_id', $request->host_id)->first();

    // If host is found, check the password
    if ($host && Hash::check($request->password, $host->password)) {
        // Password matches, so store the competition_id in session
        $competition_id = $host->competition_id;
        session(['host_id' => $request->host_id, 'competition_id' => $competition_id]);

        // Redirect to the ready page
        return redirect()->route('questions.show');
    } else {
        // If no matching host or invalid password, return to login with an error message
        return redirect()->route('calling.login')->with('error', 'Invalid Host ID or Password.');
    }

}

public function loginSubmitUser(Request $request)
{
    // Validate the input data
    $request->validate([
        'host_id' => 'required|string',
        'password' => 'required|string',
    ]);

    // Attempt to find the host by host_id
    $host = Host::where('host_id', $request->host_id)->first();

    // If host is found, check the password
    if ($host && Hash::check($request->password, $host->password)) {
        // Password matches, so store the competition_id in session
        $competition_id = $host->competition_id;
        session(['host_id' => $request->host_id, 'competition_id' => $competition_id]);

        // Redirect to the ready page
        return redirect()->route('questions.show.user');
    } else {
        // If no matching host or invalid password, return to login with an error message
        return redirect()->route('calling.login')->with('error', 'Invalid Host ID or Password.');
    }

}


    // Update the status of a question
  public function updateQuestionStatus($competition_id, $question_id)
{


    $competitors = Competitor::where('status', 'ongoing')->pluck('id');

    $question = DB::table('questions')
        ->join('question_child as qc', 'qc.question_id', '=', 'questions.id')
        ->where('qc.competition_id', $competition_id)
        ->whereIn('qc.competitor_id', $competitors) // Ensure only relevant competitors are included
        ->where('qc.status', 'active')
        ->where('question_id', $question_id)

        ->update(['status' => 'inactive']);

    return response()->json(['message' => 'Question status updated to inactive']);
}

































public function store(Request $request)
{
    try {
        $validatedData = $request->validate([
            'competition_id' => 'required',
            'question_name' => 'required|string|max:255',
            'age_category_id' => 'required',
            'side_category_id' => 'required',
            'read_category_id' => 'required',
            'book_number' => 'required|string',
            'from_ayat_number' => 'required|integer',
            'to_ayat_number' => 'required|integer',
            'hardness' => 'required|integer|min:0|max:100',
        ]);

        // Add the user_id to the validated data
        $validatedData['user_id'] = Auth::id();

        // Create the question
        Question::create($validatedData);

        return redirect()->back()->with('success', 'Question saved successfully!');
    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::error('Validation error: ' . $e->getMessage());
        return redirect()->back()->withErrors($e->validator)->withInput();
    } catch (\Exception $e) {
        \Log::error('Error saving question: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to save the question. Please try again.');
    }
}


public function update(Request $request, $id)
{
    try {
        $validatedData = $request->validate([
            'competition_id' => 'required',
            'question_name' => 'required|string|max:255',
            'age_category_id' => 'required',
            'side_category_id' => 'required',
            'read_category_id' => 'required',
            'book_number' => 'required|string', // Now a single value
            // 'surah' => 'required',
            'from_ayat_number' => 'required|integer',
            'to_ayat_number' => 'required|integer',
            'hardness' => 'required|integer|min:0|max:100',
        ]);

        $question = Question::findOrFail($id);

        // Update the question
        $question->update($validatedData);

        return redirect()->route('questions.list')->with('success', 'Question updated successfully!');
    } catch (\Exception $e) {
        \Log::error('Error updating question: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to update the question. Please try again.');
    }
}
















// public function bulkUpload(Request $request)
// {
//     $request->validate([
//         'file' => 'required|mimes:csv,txt|max:2048',
//     ]);

//     try {
//         $file = $request->file('file');
//         $data = array_map('str_getcsv', file($file));
//         $header = $data[0]; // Assuming the first row contains column names
//         $rows = array_slice($data, 1);

//         foreach ($rows as $row) {
//             $rowData = array_combine($header, $row);
//             Question::create([
//                 'competition_name' => $rowData['competition_name'],
//                 'question_name' => $rowData['question_name'],
//                 'age_category' => $rowData['age_category'],
//                 'side_category' => $rowData['side_category'],
//                 'read_category' => $rowData['read_category'],
//                 'book_number' => $rowData['book_number'],
//                 'surah' => $rowData['surah'],
//                 'from_ayat_number' => $rowData['from_ayat_number'],
//                 'to_ayat_number' => $rowData['to_ayat_number'],
//                 'hardness' => $rowData['hardness'],
//             ]);
//         }

//         return redirect()->back()->with('success', 'Questions uploaded successfully!');
//     } catch (\Exception $e) {
//         \Log::error('Bulk upload error: ' . $e->getMessage());
//         return redirect()->back()->with('error', 'Failed to upload questions. Please check the file format.');
//     }
// }


public function bulkUpload(Request $request)
{
    // Validate the uploaded file
    $request->validate([
        'file' => 'required|mimes:csv,txt|max:2048', // Ensure it's a CSV or TXT file
    ]);

    try {
        $file = $request->file('file');
        $data = array_map('str_getcsv', file($file)); // Parse the CSV file
        $header = $data[0]; // Assuming the first row contains column names
        $rows = array_slice($data, 1); // Data rows start after the header

        // Validate that required columns exist in the header
        $requiredColumns = [
            'competition_id', 'question_name', 'age_category_id',
            'side_category_id', 'read_category_id', 'book_number',
            'surah', 'from_ayat_number', 'to_ayat_number', 'hardness'
        ];

        foreach ($requiredColumns as $column) {
            if (!in_array($column, $header)) {
                throw new \Exception("Missing required column: $column");
            }
        }

        // Add user_id to header if not already present
        if (!in_array('user_id', $header)) {
            array_unshift($header, 'user_id');
        }

        // Process each row
        foreach ($rows as $row) {
            // Add user_id value to the row
            array_unshift($row, Auth::id());

            $rowData = array_combine($header, $row);

            // Validate individual row data
            $validator = \Validator::make($rowData, [
                'user_id' => 'required|integer',
                'competition_id' => 'required|integer',
                'question_name' => 'required|string|max:255',
                'age_category_id' => 'required|integer',
                'side_category_id' => 'required|integer',
                'read_category_id' => 'required|integer',
                'book_number' => 'required|string|max:255',
                'from_ayat_number' => 'required|integer|min:1',
                'to_ayat_number' => 'required|integer|min:1',
                'hardness' => 'required|integer|min:0|max:100',
            ]);

            if ($validator->fails()) {
                \Log::error('Row validation failed: ' . json_encode($validator->errors()->all()));
                continue;
            }

            Question::create([
                'user_id' => $rowData['user_id'],
                'competition_id' => $rowData['competition_id'],
                'question_name' => $rowData['question_name'],
                'age_category_id' => $rowData['age_category_id'],
                'side_category_id' => $rowData['side_category_id'],
                'read_category_id' => $rowData['read_category_id'],
                'book_number' => $rowData['book_number'],
                'from_ayat_number' => $rowData['from_ayat_number'],
                'to_ayat_number' => $rowData['to_ayat_number'],
                'hardness' => $rowData['hardness'],
            ]);
        }

        return redirect()->back()->with('success', 'Questions uploaded successfully!');
    } catch (\Exception $e) {
        \Log::error('Bulk upload error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to upload questions. Please check the file format and try again.');
    }
}













public function destroy($id)
{
    try {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('questions.list')->with('success', 'Question deleted successfully!');
    } catch (\Exception $e) {
        \Log::error('Error deleting question: ' . $e->getMessage());
        return redirect()->route('client.questions.list')->with('error', 'Failed to delete the question.');
    }
}


public function view($id)
{
    // Load question along with related categories
    $question = Question::with(['ageCategory', 'sideCategory', 'readCategory'])->findOrFail($id);

    return view('client.questions.view', compact('question'));
}





}
