<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
$user = User::find(Auth::id());

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announce Competition</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/createcompetition.css">
    <!-- jQuery CDN -->
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


        .competition-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .competition-form input {
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 10px;
            outline: none;
        }

        .competition-form .save-btn {
            background-color: var(--secondary-color);
            ;
            color: var(--primary-color);
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .competition-form .save-btn:hover {
            background-color: var(--secondary-color);
        }
        .heading{
        background: #016da8;
        border-radius: 15px;
        color: white;
    }
    </style>
  <style>
    .custom-file-upload {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .upload-label {
        background-color: #007bff;
        color: white;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
    }

    .upload-label:hover {
        background-color: #0056b3;
    }

    span[id$="-file-name"] {
        font-size: 14px;
        color: #666;
    }

    input[type="file"] {
        display: none;
    }
    .text-primary{
       color: #00a497;
    }
</style>
</head>

<body>



    <header class="header">
        {{-- <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a> --}}
        <h1>{{ $competition->main_name }}</h1>
    </header>

    <div class="container1">
        

        <div class="tabs">

                <button class="tab-btn {{ empty($competition->curriculum) ? 'disabled' : '' }}"
                        onclick="showCurriculum()"
                        title="{{ empty($competition->curriculum) ? 'No curriculum file available for this record.' : '' }}">
                    Curriculum
                </button>
                
                <button class="tab-btn {{ empty($competition->rules) ? 'disabled' : '' }}"
                        onclick="showRules()"
                        title="{{ empty($competition->rules) ? 'No rules file available for this record.' : '' }}">
                    Rules
                </button>

                <style>
                    .disabled {
                                    opacity: 0.5;
                                    cursor: not-allowed;
                                    pointer-events: none; /* Prevents clicking */
                                }
                </style>

                <button class="tab-btn"
                onclick="showApplicantsForm()">Fill out the form
           </button>

        </div>
    </div>
    <div class="container">
        <div class="row" id="applicants_form">
            @if(Carbon\Carbon::now()->greaterThan(Carbon\Carbon::parse($competition->end_date)))
            <p class="text-primary">Sorry...<br>
                The deadline of this competition has been ended</br>
                - Thank you -
            </p>
            @else
            <div class="col-md-6 col-sm-12 offset-md-3">
                <p style="color: #21b68e; font-weight: bold; padding-top:20px;"><span style="text-align: left">{{$competition->end_date}}</span> <span style="padding-left: 50px;">Deadline for submitting names</span></p>
                <h6 class="heading col-12 py-3 my-3" style="background-color:#21b68e; border-radius: 30px;;">To perticipate in the competition please complete the form below</h6>
                <div class="form-container px-0">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="competition-form" method="POST" action="{{ route('competition.apply') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $competition->id }}" name="competition_id">
                        <input type="text" value="{{ old('name') }}" class="form-control" id="name" name="name" placeholder="Full name (English)" required>
                        <input type="text" value="{{ old('name_Dhivehi') }}" class="form-control" id="name_Dhivehi" name="name_Dhivehi" placeholder="Full name (Dhivehi)" >

                        <input type="text" value="{{ old('id_card') }}" class="form-control" id="id_card" name="id_card" placeholder="ID Card / Passport #" required>
                        <input type="text" value="{{ old('permanent_address') }}" class="form-control" id="permanent_address" name="permanent_address" placeholder="Permanent Address" required>
                        <input type="text" value="{{ old('current_address') }}" class="form-control" id="current_address" name="current_address" placeholder="Current Address" required>

                        <input type="text" value="{{ old('city') }}" class="form-control" id="city" name="city" placeholder="Island / City" required>

                        <div class="row">
                            <div class="col">
                                <label for="dob" class="form-label text-start">Date of Birth</label>
                                <input type="date" value="{{ old('dob') }}" class="form-control text-muted" id="dob" name="dob" required>
                            </div>
                            <div class="col">
                                <label for="age" class="form-label text-start">Age</label>
                                <input type="number" value="{{ old('age') }}" class="form-control" id="age" name="age" placeholder="Age" required readonly>
                            </div>
                        </div>

                        <input type="text"  value="{{ old('organization') }}"  id="organization"  name="organization" placeholder="Behalf of any office or School (Dhivehi)" required>
                        <input type="text" value="{{ old('parent_name') }}"  id="parent_name"  name="parent_name" placeholder="Parent name (Dhivehi)">
                        <input type="text" value="{{ old('number') }}"  id="number"  name="number" placeholder="Phone number (Dhivehi)" required>
                        <select name="age_category" class="form-select text-muted" id="age_category" required>
                            <option value="" disabled selected>Select Age Category</option>
                            @foreach ($age_categories as $entry)
                                <option {{ old('age_category') == $entry->id ? 'Selected' : ''  }} value="{{ $entry->id }}">{{ $entry->name }}</option>
                            @endforeach
                        </select>
                        <select name="side_category" class="form-select text-muted" id="side_category" required>
                            <option value="" disabled selected>Select Recitation Piece</option>
                            @foreach ($side_categories as $entry)
                                <option {{ old('age_category') == $entry->id ? 'Selected' : ''  }} value="{{ $entry->id }}">{{ $entry->name }}</option>
                            @endforeach
                        </select>
                        <select name="read_category" class="form-select text-muted" id="read_category" required>
                            <option value="" disabled selected>Select Method of Recitation</option>
                            @foreach ($read_categories as $entry)
                                <option {{ old('age_category') == $entry->id ? 'Selected' : ''  }} value="{{ $entry->id }}">{{ $entry->name }}</option>
                            @endforeach
                        </select>
                        <div class="row">
                            <div class="col-md-5 col-sm-12 pr-0 mb-3">
                                <div class="custom-file-upload">
                                    <label for="photo" class="upload-label">Upload Photo</label>
                                    <input type="file" accept=".png,.jpg" name="photo" id="photo" class="form-control" hidden>
                                    <span id="photo-file-name">No file chosen</span>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-12 pr-0">
                                <div class="custom-file-upload">
                                    <label for="id_card_photo" class="upload-label">ID Card / Passport</label>
                                    <input type="file" accept=".png,.jpg" name="id_card_photo" id="id_card_photo" class="form-control" hidden>
                                    <span id="id-card-file-name">No file chosen</span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-save">Submit</button>
                    </form>


                </div>

            </div>
            @endif
        </div>
        <!-- Form Section -->

        <!-- Curriculam -->
        <div class="row" id="competetion_curriculum">
        <div class="col-md-6 col-sm-12 offset-md-3">
                <h6 class="heading col-12 py-3 my-3" style="background-color:#21b68e; border-radius: 30px;;">Curriculum</h6>
                <div class="form-container px-0">
                    <button class="tab-btn {{ empty($competition->curriculum) ? 'disabled' : '' }}"
                        onclick="{{ !empty($competition->curriculum) ? "window.location.href='" . url('public/' . $competition->curriculum) . "'" : '' }}"
                        title="{{ empty($competition->curriculum) ? 'No curriculum file available for this record.' : '' }}">
                    Download
                </button>
                <button class="tab-btn {{ empty($competition->curriculum) ? 'disabled' : '' }}"
                        onclick="{{ !empty($competition->curriculum) ? "window.location.href='" . url('public/' . $competition->curriculum) . "'" : '' }}"
                        title="{{ empty($competition->curriculum) ? 'No curriculum file available for this record.' : '' }}">
                    View
                </button>
                </div>

            </div>                 
        </div>
        <!-- Rules -->                        
        <div class="row" id="competetion_rules">
        <div class="col-md-6 col-sm-12 offset-md-3">
                <h6 class="heading col-12 py-3 my-3" style="background-color:#21b68e; border-radius: 30px;;">Rules</h6>
                <div class="form-container px-0">
                <button class="tab-btn {{ empty($competition->rules) ? 'disabled' : '' }}"
                        onclick="{{ !empty($competition->rules) ? "window.location.href='" . url('public/' . $competition->rules) . "'" : '' }}"
                        title="{{ empty($competition->rules) ? 'No rules file available for this record.' : '' }}">
                    Download
                </button>
                <button class="tab-btn {{ empty($competition->rules) ? 'disabled' : '' }}"
                        onclick="{{ !empty($competition->rules) ? "window.location.href='" . url('public/' . $competition->rules) . "'" : '' }}"
                        title="{{ empty($competition->rules) ? 'No rules file available for this record.' : '' }}">
                    View
                </button>
                </div>

            </div>                     
        </div>
        
    </div>


    @include('includes.footer')
    <script>
        document.getElementById('photo').addEventListener('change', function () {
            const fileName = this.files[0] ? this.files[0].name : 'No file chosen';
            document.getElementById('photo-file-name').textContent = fileName;
        });

        document.getElementById('id_card_photo').addEventListener('change', function () {
            const fileName = this.files[0] ? this.files[0].name : 'No file chosen';
            document.getElementById('id-card-file-name').textContent = fileName;
        });
    </script>
    <script>
        document.getElementById('dob').addEventListener('change', function () {
            const dob = new Date(this.value); // Get the selected DOB
            const today = new Date(); // Current date
            let age = today.getFullYear() - dob.getFullYear(); // Calculate the year difference

            // Adjust if the current date is before the birthday this year
            const monthDiff = today.getMonth() - dob.getMonth();
            const dayDiff = today.getDate() - dob.getDate();
            if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
                age--;
            }

            // Display the age or a warning if the DOB is invalid
            const ageDisplay = document.getElementById('age');
            ageDisplay.value = age;
        });
    </script>
    <script>
        var applicants_form = document.getElementById('applicants_form');
        var competetion_curriculum = document.getElementById('competetion_curriculum');
        var competetion_rules = document.getElementById('competetion_rules');
        console.log("debug.hello");

        applicants_form.style.display = "block";
        competetion_curriculum.style.display = "none";
        competetion_rules.style.display = "none";

        function showApplicantsForm(){
            var applicants_form = document.getElementById('applicants_form');
            var competetion_curriculum = document.getElementById('competetion_curriculum');
            var competetion_rules = document.getElementById('competetion_rules');
            console.log("debug.form");

            applicants_form.style.display = "block";
            competetion_curriculum.style.display = "none";
            competetion_rules.style.display = "none";
        }

        function showCurriculum(){
            var applicants_form = document.getElementById('applicants_form');
            var competetion_curriculum = document.getElementById('competetion_curriculum');
            var competetion_rules = document.getElementById('competetion_rules');
            console.log("debug.curriculum");

            applicants_form.style.display = "none";
            competetion_curriculum.style.display = "block";
            competetion_rules.style.display = "none";
        }

        function showRules(){
            var applicants_form = document.getElementById('applicants_form');
            var competetion_curriculum = document.getElementById('competetion_curriculum');
            var competetion_rules = document.getElementById('competetion_rules');
            console.log("debug.rules");

            applicants_form.style.display = "none";
            competetion_curriculum.style.display = "none";
            competetion_rules.style.display = "block";
        }
    //    $(document).ready(function () {
    //         $("#applicants_form").show();
    //         $('#competetion_curriculum').hide();
    //         $('#competetion_rules').hide();
    //         $("#btn").click(function () {
    //         $("#Create").toggle();
    //         });
    //     });
    </script>

</body>

</html>
