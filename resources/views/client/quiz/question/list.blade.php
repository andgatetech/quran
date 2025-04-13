<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Competition List</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <link rel="stylesheet" href="css/CompetitionList.css">
  <style>


.btn {
      font-size: .9rem !important;
      border-radius: .3rem !important;
      padding: .4rem 0 !important;
      border: 1px solid var(--secondary-color) !important;
      background-color: var(--secondary-color) !important;
      color: var(--primary-color) !important;
      cursor: pointer !important;
      text-align: center !important;
      margin: 5px !important;
    }
       .btn:hover {

        border: 1px solid var(--secondary-color) !important;
      background-color: var(--primary-color) !important;
      color: var(--secondary-color) !important;

    }


    .competition-list {

      border-radius: 10px;
    }

    .list-heading {
      background-color: var(--secondary-color);
      color: var(--primary-color);
      padding: 10px;
      text-align: center;
      border-radius: 10px;
      font-size: 14px;
    }

    .competitions-container {
      margin-top: 20px;
      max-height: 60rem;
      min-height: 10rem;
      overflow-y: auto; /* Enable vertical scrollbar when content overflows */
    }

    /* Competition Cards */
    .competition-card {
      background: white;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 10px 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .competition-main-name p,
    .competition-sub-name p {
      font-size: 16px;
      margin-bottom: 5px;
      text-align: left;
      cursor: pointer; /* Add cursor pointer to indicate it is clickable */
    }

    .competition-main-name span,
    .competition-sub-name span {
      color: var(--secondary-color);
      float: right;
    }
    .competition-sub-name span a {
      color: var(--secondary-color);
      float: right;
      text-decoration: none;
    }

    .competition-main-name i {
      float: right;
      color: #888;
    }
    p{
        font-size: 16px;
    }
    .heading{
        background: #C42B4A;
        border-radius: 15px;
        color: white;
    }

    .delete-btn, .edit-btn {
        padding: 10px 50px !important;
        border-radius: 15px !important;
    }
    .download-btn, .view-btn {
        padding: 5px 10px !important;
        border-radius: 5px !important;
        float: left !important;
    }
    .clearfix {
    clear: both; /* Stops floating elements on both sides */
    }
    @media (max-width: 435px) {
        .competition-main-name p,
    .competition-sub-name p {
            font-size: 13px;
        }
    }




  </style>
</head>
<body>

<!-- top bar -->
<header class="header">
    <a class="back-btn" href="{{ route('client.menu.quiz') }}"><i class="fas fa-home"></i></a>
    <h1>Question List(Quiz)</h1>
</header>

  <div class="container1">
    <div class="tabs">

      <button class="tab-btn" onclick="window.location.href='{{ route('quiz.question.create') }}'">Create Questions</button>
      <button class="tab-btn active" onclick="window.location.href='{{ route('quiz.question.list') }}'">Question List</button>
   
   
      
   
   
    </div>

    <form action="{{ route('quiz.question.list') }}" method="get">
            <div class="row">
                
                <div class="col-6">
                    <select class="form-select" name="competition" id="competition">
                        <option value=""> Competition</option>
                       
                    </select>
                </div>
                <div class="col-6">
                    <select class="form-select" name="age_category" id="age_category">
                        <option value="">Participants</option>
                       
                    </select>
                </div>

            </div>
            <div class="row my-3">
                <div class="col-6">
                    <select class="form-select" name="option_name" id="side_category">
                        <option value="">Question Option</option>
                        <option value="Multiple">Multiple</option>
                        <option value="Text">Text</option>
                       
                    </select>
                </div>
                <div class="col-6">
                    <select class="form-select" name="read_category" id="read_category">
                        <option value="">From Date/ To Date</option>
                        
                    </select>
                </div>
            </div>
            <div class="tabs">
                <input type="submit" value="Generate" class="tab-btn active px-5">
            </div>
        </form>

  </div>

  <div class="container">
    <div class="row mb-4">
        <div class="col-md-6 col-sm-12 offset-md-3">
            <h6 class="heading col-12 py-3 my-3"> Question List</h6>
            @foreach($quiz_questions as $question)
               @php 
                $competition_info=DB::table('competitions')->where('id',$question->competition_id)->first();
               @endphp
                <div class="competition-card">
                    <!-- Main Name with Dropdown Toggle -->
                    <div class="competition-main-name" onclick="toggleDropdown(this)">
                        <p>Competition Name : <span>{{ $competition_info->main_name }}</span></p>
                    </div>

                    <!-- Question Name -->
                    <div class="competition-main-name" onclick="toggleDropdown(this)">
                        <p>Question Name : <span>{{ $question->question_name }}</span></p>
                    </div>
                    
                    <!-- Option Name -->
                    <div class="competition-main-name" onclick="toggleDropdown(this)">
                        <p>Option Name : <span>{{ $question->option_name }}</span></p>
                    </div>
                    @if($question->option_name=="Multiple")
                      <!-- Answer -->
                      <div class="competition-main-name" onclick="toggleDropdown(this)">
                          <p>Answer : <span>{{ $question->option_name }}</span></p>
                      </div>
                      @if(count($question->questionAnswer)>0)
                        @php 
                        $i=0;
                        @endphp
                        @foreach($question->questionAnswer as $answer)
                          @php
                          $i++;
                          @endphp
                          
                          <div class="competition-main-name" onclick="toggleDropdown(this)">
                           <p style="color:red;">{{$i}}.{{$answer->answer_name}}</p>
                          </div>  
                        @endforeach
                      @endif  

                      <!-- Correct Answer -->
                      <div class="competition-main-name" onclick="toggleDropdown(this)">
                          <p>Correct Answer :</p>
                      </div>
                       @if(count($question->questionAnswer)>0)
                        @php 
                        $i=0;
                        @endphp
                        @foreach($question->questionAnswer as $answer)
                          
                          @php
                          $i++;
                          if($answer->correct_answer_status=="No"){
                            continue;
                          }
                          @endphp
                          
                          <div class="competition-main-name" onclick="toggleDropdown(this)">
                           <p style="color:red;">{{$i}}.{{$answer->answer_name}}</p>
                          </div>  
                        @endforeach
                      @endif  
                    @endif
                    
                    <div class="competition-sub-name">
                        <p>Dead Line : <span>{{ Carbon\Carbon::parse($question->dead_line)->format('d-m-Y') }}</span></p>
                    </div>
                    
                    <div class="competition-sub-name">
                        <p>URL : <span><a href="{{ $question->url }}" target="_blank">{{ $question->url }}</a></span></p>
                    </div>
                    
                    <!-- Buttons -->
                    <div class="d-flex justify-content-center align-items-center mt-3">
                    <a href="{{ route('quiz.question.edit', $question->id) }}" class="btn edit-btn">Edit</a>
                    <form action="{{ route('quiz.question.delete', $question->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                        @csrf
                        @method('DELETE')  <!-- Spoofing DELETE request -->
                        <button type="submit" class="btn delete-btn">Delete</button>
                    </form>
    
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @if($competitions->isEmpty())
        <p>No Question. Click "Create Question" to add one.</p>
    @endif
</div>

  @include('includes.footer')


</body>
</html>
