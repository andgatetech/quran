<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competition Application List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

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
            overflow-y: auto;
            /* Enable vertical scrollbar when content overflows */
        }

        /* Competition Cards */
        .competition-card {
            background: white;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .competition-main-name,
        .competition-sub-name {
            padding-right: 20px;
        }

        .competition-main-name p,
        .competition-sub-name p {
            font-size: 16px;
            margin-bottom: 5px;
            cursor: pointer;
            /* Add cursor pointer to indicate it is clickable */
            text-align: left;
        }

        .competition-main-name span,
        .competition-sub-name span {
            color: var(--secondary-color);
            float: right;
        }

        .competition-main-name i {
            color: var(--secondary-color);
            float: right;
        }

        .competition-main-name i {
            float: right;
            color: #888;
        }

        /* Hide Sub Name and Buttons by Default */
        .competition-sub-name,
        .card-buttons {
            display: none;
        }

        /* Show Buttons and Sub Name when Active */
        .competition-main-name.active+.competition-sub-name,
        .competition-main-name.active+.competition-sub-name+.card-buttons {
            display: block;
        }

        @media (max-width: 435px) {

            .competition-main-name p,
            .competition-sub-name p {
                font-size: 13px;
            }
        }

        .delete-btn,
        .edit-btn {
            padding: 10px 50px !important;
            border-radius: 15px !important;
        }

        .form-select {
            border-radius: 15px;
        }
        #remarks{
            border-radius: 15px;
        }
        .text-primary{
            color: var(--secondary-color) !important;
        }
    </style>
</head>

<body>

    <header class="header">
        <a class="back-btn" href="{{ route('client.menu.quiz') }}"><i class="fas fa-home"></i></a>
        <h1>Answer List</h1>
    </header>

    <div class="container1">
        <div class="tabs">
            <button class="tab-btn {{ $status == 'Pending' ? 'active' : ''  }}"
                onclick="window.location.href='{{ route('quiz.competator.answer.list', 'status=Pending') }}'"> &nbsp;&nbsp;Pending &nbsp;&nbsp;</button>
            <button class="tab-btn px-2 {{ $status == 'Correct' ? 'active' : ''  }}"
                onclick="window.location.href='{{ route('quiz.competator.answer.list', 'status=Correct') }}'"> &nbsp;&nbsp; Approved  &nbsp;&nbsp;</button>
            <button class="tab-btn px-2 {{ $status == 'Wrong' ? 'active' : ''  }}"
                onclick="window.location.href='{{ route('quiz.competator.answer.list', 'status=Wrong') }}'">Rejected</button>

        </div>
        <form action="{{ route('quiz.competator.answer.list') }}" method="get">
            <div class="row">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <input type="hidden" name="status" value="{{ $status }}">
                <div class="col-6">
                    <select class="form-select" name="competition" id="competition">
                        <option value=""> Competition</option>
                        @foreach ($competitions as $competition)
                            <option {{ request()->competition == $competition->id ? 'Selected' : '' }}
                                value="{{ $competition->id }}">{{ $competition->main_name }}</option>
                        @endforeach
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
                        <option value="">From Date/To Date</option>
                       
                    </select>
                </div>
            </div>
            <div class="tabs">
                <input type="submit" value="Search" class="tab-btn active px-5">
            </div>
        </form>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 col-sm-12">

                @foreach($answers as $application)
                    @php
                       $question_info=DB::table('quiz_questions')->where('id',$application->question_id)->first();
                       $competition_info=DB::table('competitions')->where('id',$question_info->competition_id)->first();
                       $answer_info=DB::table('quiz_question_answers')->where('id',$application->answer_id)->first(); 
                    @endphp
                    <div class="competition-card">
                        <!-- Main Name with Dropdown Toggle -->
                        <div class="competition-main-name" onclick="toggleDropdown(this)">
                            <p>Competition Main Name: <span><?php if(isset($competition_info->main_name)) echo $competition_info->main_name ?>

                                <i class="fas fa-chevron-down" style="position: absolute"></i>
                                </span>

                            </p>
                        </div>
                        <!-- Sub Name, initially hidden -->
                        <div class="competition-sub-name">
                            <p>Participant Name: <span>{{ $application->participant_name }}</span></p>
                            <p>ID Card / Passport # : <span>{{ $application->id_card }}</span></p>
                            <p>Phone No : <span>{{ $application->phone_number }}</span></p>
                            <p>Question Name: <span>{{ $question_info->question_name }}</span></p>
                            <p>Question Option: <span>{{ $question_info->option_name }}</span></p>
                            <p>Answer: <span>{{ $answer_info->answer_name }}</span></p>
                            
                            <!-- Add a new row for number_of_questions -->
                         <!--   <p class="pt-3 pb-2">Number of Questions:</p>-->
                           
                          
                            

                        
                            
                            @if($status == 'Pending')
                            
                            <p>Status : <span class="{{ $application->answer_status=='Approved' ? 'text-primary' : 'text-danger' }}">{{ $application->answer_status }}</span></p>
                            
                            @endif
                            <div>
                                @if($status == 'Pending')
                                    <form action="{{ route('quiz.answer.status.update') }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        <input type="hidden" name="competator_answer_id" value="{{ $application->id }}">
                                        <input type="hidden" name="status" value="Wrong">
                                        
                                        <button type="submit" class="btn delete-btn">Rejected</button>
                                    </form>
                                    <form action="{{ route('quiz.answer.status.update') }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        <input type="hidden" name="competator_answer_id" value="{{ $application->id }}">
                                        <input type="hidden" name="status" value="Correct">
                                        
                                        <button type="submit" class="btn edit-btn">Approve</button>
                                    </form>
                                    @else
                                    <form action="{{ route('quiz.answer.status.update') }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        <input type="hidden" name="status" value="Pending">
                                        <input type="hidden" name="competator_answer_id" value="{{ $application->id }}">
                                        <button type="submit" class="btn delete-btn">Recheck</button>
                                    </form>
                                @endif
                            </div>

                        </div>
                    </div>


                    

                   

                @endforeach
            </div>
        </div>

        @if($answers->isEmpty())
            <p>No Answer Found.</p>
        @endif
    </div>
    <!-- Participant Photo Modal -->

    @include('includes.footer')
    <script>
        function updateApproveUnproveRemarksField(){
            var remarksInput = document.getElementById('remarks').value;
            var remarksValue = remarksInput.trim();
            console.log("debug remarks");
            console.log(remarksInput);
            document.getElementById('remarks_unapprove').value = remarksValue;
            document.getElementById('remarks_approve').value = remarksValue;
            return true;
        }
        function validateRemarks() {
            const remarksInput = document.getElementById('remarks');
            const remarksValue = remarksInput.value.trim();

            

            console.log(remarksValue);

            if (remarksValue === '') {
                alert('Please add remarks before submitting.');
                remarksInput.focus();
                return false; // Prevent form submission
            }

            // // Copy the remarks value to the hidden inputs
            // document.getElementById('remarks_unapprove').value = remarksValue;
            // document.getElementById('remarks_approve').value = remarksValue;
            // console.log("debug");    
            // return true; // Allow form submission
        }
    </script>
    <script>
        // JavaScript to toggle dropdown and change arrow direction
        function toggleDropdown(element) {
            var subName = element.nextElementSibling; // Get the sub-name div
            var icon = element.querySelector('i'); // Get the arrow icon
            var buttons = subName.nextElementSibling; // Get the button div

            // Toggle visibility of sub-name and buttons
            if (subName.style.display === "none" || subName.style.display === "") {
                subName.style.display = "block"; // Show the sub-name
                // buttons.style.display = "flex"; // Show the buttons
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                subName.style.display = "none"; // Hide the sub-name
                // buttons.style.display = "none"; // Hide the buttons
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        }

        // Ensure all dropdowns are closed on page load
        window.onload = function () {
            var allSubNames = document.querySelectorAll('.competition-sub-name');
            var allButtons = document.querySelectorAll('.card-buttons');
            allSubNames.forEach(function (subName) {
                subName.style.display = "none";
            });
            allButtons.forEach(function (button) {
                button.style.display = "none";
            });
        }
    </script>
    
</body>

</html>
