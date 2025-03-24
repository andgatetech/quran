<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competition List</title>
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
        <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a>
        <h1>Competition List</h1>
    </header>

    <div class="container1">
        <div class="tabs">
            <button class="tab-btn {{ $status == 'Pending' ? 'active' : ''  }}"
                onclick="window.location.href='{{ route('registrations.index', 'status=Pending') }}'"> &nbsp;&nbsp;Pending &nbsp;&nbsp;</button>
            <button class="tab-btn px-2 {{ $status == 'Approved' ? 'active' : ''  }}"
                onclick="window.location.href='{{ route('registrations.index', 'status=Approved') }}'"> &nbsp;&nbsp; Approved  &nbsp;&nbsp;</button>
            <button class="tab-btn px-2 {{ $status == 'Un-Approved' ? 'active' : ''  }}"
                onclick="window.location.href='{{ route('registrations.index', 'status=Un-Approved') }}'">Un
                Approved</button>

        </div>
        <form action="{{ route('registrations.index') }}" method="get">
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
                        <option value="">Age Category</option>
                        @foreach ($age_categories as $age_category)
                            <option {{ request()->age_category == $age_category->id ? 'Selected' : '' }}
                                value="{{ $age_category->id }}">{{ $age_category->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="row my-3">
                <div class="col-6">
                    <select class="form-select" name="side_category" id="side_category">
                        <option value="">Side Category</option>
                        @foreach ($side_categories as $side_category)
                            <option {{ request()->side_category == $side_category->id ? 'Selected' : '' }}
                                value="{{ $side_category->id }}">{{ $side_category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <select class="form-select" name="read_category" id="read_category">
                        <option value="">Read Category</option>
                        @foreach ($read_categories as $read_category)
                            <option {{ request()->read_category == $read_category->id ? 'Selected' : '' }}
                                value="{{ $read_category->id }}">{{ $read_category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="tabs">
                <input type="submit" value="Generate" class="tab-btn active px-5">
            </div>
        </form>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 col-sm-12">

                @foreach($applications as $application)
                    <div class="competition-card">
                        <!-- Main Name with Dropdown Toggle -->
                        <div class="competition-main-name" onclick="toggleDropdown(this)">
                            <p>Competition Main Name: <span>{{ $application->competition->main_name }}

                                    <i class="fas fa-chevron-down" style="position: absolute"></i>
                                </span>

                            </p>
                        </div>
                        <!-- Sub Name, initially hidden -->
                        <div class="competition-sub-name">
                            <p>Participant Name: <span>{{ $application->name }}</span></p>
                            <p>ID Card / Passport # : <span>{{ $application->id_card }}</span></p>
                            <p>Permanent Address : <span>{{ $application->permanent_address }}</span></p>
                            <p>Current Address : <span>{{ $application->current_address }}</span></p>
                            <p>Island / City : <span>{{ $application->city }}</span></p>
                            <p>Date Of Birth : <span>{{ $application->dob }}</span></p>
                            <p>Age : <span>{{ $application->age }}</span></p>
                            <p>Organization : <span>{{ $application->organization }}</span></p>
                            <p>Parent Name : <span>{{ $application->parent_name ?? 'NA' }}</span></p>
                            <p>Contact # : <span>{{ $application->number }}</span></p>
                            <p>Age Category : <span>{{ $application->ageCategory->name }}</span></p>
                            <p>Side Category : <span>{{ $application->sideCategory->name }}</span></p>
                            <p>Read Category : <span>{{ $application->readCategory->name }}</span></p>
                            <p class="pt-2">Participant Photo:
                                <span>
                                    <button type="button" class="tab-btn active px-4 py-1" data-bs-toggle="modal"
                                        data-bs-target="#participantPhotoModal{{ $application->id }}">
                                        View
                                    </button>
                                </span>
                            </p>
                            <p class="pt-3 pb-2">ID / Card Passport Photo:
                                <span>
                                    <button type="button" class="tab-btn active px-4 py-1" data-bs-toggle="modal"
                                        data-bs-target="#passportPhotoModal{{ $application->id }}">
                                        View
                                    </button>
                                </span>
                            </p>
                            @if($status == 'Pending')
                            <input type="text" class="form-control mt-4 mb-2" name="remarks" id="remarks"
                                placeholder="Remarks">
                            @else
                            <p>Status : <span class="{{ $application->status=='Approved' ? 'text-primary' : 'text-danger' }}">{{ $application->status }}</span></p>
                            <p>Remarks : <span class="text-primary">{{ $application->remarks }}</span></p>
                            @endif
                            <div>
                                @if($status == 'Pending')
                                    <form action="{{ route('update-application-status') }}" method="POST"
                                        style="display:inline-block;" onsubmit="return validateRemarks()">
                                        @csrf
                                        <input type="hidden" name="application_id" value="{{ $application->id }}">
                                        <input type="hidden" name="status" value="Un-Approved">
                                        <input type="hidden" name="remarks" id="remarks_unapprove">
                                        <button type="submit" class="btn delete-btn">Un Approve</button>
                                    </form>
                                    <form action="{{ route('update-application-status') }}" method="POST"
                                        style="display:inline-block;" onsubmit="return validateRemarks()">
                                        @csrf
                                        <input type="hidden" name="application_id" value="{{ $application->id }}">
                                        <input type="hidden" name="status" value="Approved">
                                        <input type="hidden" name="remarks" id="remarks_approve">
                                        <button type="submit" class="btn edit-btn">Approve</button>
                                    </form>
                                    @else
                                    <form action="{{ route('update-application-status') }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        <input type="hidden" name="status" value="Pending">
                                        <input type="hidden" name="application_id" value="{{ $application->id }}">
                                        <button type="submit" class="btn delete-btn">Recheck</button>
                                    </form>
                                @endif
                            </div>

                        </div>
                    </div>


                    <div class="modal fade" id="participantPhotoModal{{ $application->id }}" tabindex="-1"
                        aria-labelledby="participantPhotoLabel{{ $application->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="participantPhotoLabel{{ $application->id }}">Participant
                                        Photo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('public/'.$application->photo) }}" alt="Participant Photo" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Passport Photo Modal -->
                    <div class="modal fade" id="passportPhotoModal{{ $application->id }}" tabindex="-1"
                        aria-labelledby="passportPhotoLabel{{ $application->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="passportPhotoLabel{{ $application->id }}">ID / Card Passport
                                        Photo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('public/'.$application->id_card_photo) }}" alt="Passport Photo"
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>

        @if($applications->isEmpty())
            <p>No Registration Request found.</p>
        @endif
    </div>
    <!-- Participant Photo Modal -->

    @include('includes.footer')
    <script>
        function validateRemarks() {
            const remarksInput = document.getElementById('remarks');
            const remarksValue = remarksInput.value.trim();

            if (remarksValue === '') {
                alert('Please add remarks before submitting.');
                remarksInput.focus();
                return false; // Prevent form submission
            }

            // Copy the remarks value to the hidden inputs
            document.getElementById('remarks_unapprove').value = remarksValue;
            document.getElementById('remarks_approve').value = remarksValue;

            return true; // Allow form submission
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
                buttons.style.display = "flex"; // Show the buttons
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                subName.style.display = "none"; // Hide the sub-name
                buttons.style.display = "none"; // Hide the buttons
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
