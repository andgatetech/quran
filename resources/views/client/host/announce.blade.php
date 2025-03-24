@extends('layouts.app')

@section('content')
    <style>
        .container1 {
            margin: 2rem 0 !important;
        }
        .container {margin-bottom: 6rem}


        .button-group1 {
            display: block;
            gap: 10px;
            margin-bottom: 20px;
        }

        .button-group1 .btn {
            float: left;

            border-radius: 30px;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s;
            width: 45% !important;
            padding: .3rem 0;
            margin: .5rem .2rem;
        }
/* .{font-size: .9rem !important} */

.button-group1 .btn{color: var(--secondary-color) ;
    border:1px solid var(--secondary-color) ;
    }


.active-button{    background-color: var(--secondary-color) !important;
    color: #ffffff !important;

}
.button-group1 a:hover{background-color: var(--secondary-color) !important;
    color: #ffffff !important;}





    .question-header i {
            color: #888;
            transition: transform 0.3s;
        }

        .list-item.active .question-header i {
            transform: rotate(180deg);
        }

        .rankstatus{font-size: .8rem;}
        .rankstatus p {display: inline !important;}
        .rankstatus1{color: red}
    </style>
    <header class="header">
        <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a>
         Announce Winners
    </header>
    <div class="button-group1">
        <a href="{{ route('host.create') }}" class="btn  ">Host Competition</a>
        <a href="{{ route('competitions.list') }}" class="btn  ">Competitions</a>
        <a href="{{ route('host.announce') }}" class="btn  active-button">Announce Winners</a>
    </div>

    <div class="button-group1" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; border-radius:1rem;padding:.5rem; border:1px solid  var(--secondary-color);">
        <select id="sideCategoryFilter" class="btn ">
            <option value="">Select Side Category</option>
            @foreach ($sideCategories as $sideCategory)
                <option value="{{ $sideCategory->id }}">{{ $sideCategory->name }}</option>
            @endforeach
        </select>

        <select id="readCategoryFilter" class="btn ">
            <option value="">Select Read Category</option>
            @foreach ($readCategories as $readCategory)
                <option value="{{ $readCategory->id }}">{{ $readCategory->name }}</option>
            @endforeach
        </select>

        <select id="ageCategoryFilter" class="btn ">
            <option value="">Select Age Category</option>
            @foreach ($ageCategories as $ageCategory)
                <option value="{{ $ageCategory->id }}">{{ $ageCategory->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="container">
        <div id="competitorList">
            @foreach ($sortedCompetitors as $competitor)
                @php
                    // Check if competitor is already ranked
                    $alreadyRanked = \App\Models\Ranking::where('competitor_id', $competitor->id)->exists();

                    $totalPoints = 0;
                    $gainedPoints = 0;
                    foreach ($competitor->results as $result) {
                        $totalPoints += $result->total_points;
                        $gainedPoints += $result->gained_points;
                    }
                @endphp

<form action="{{ route('rank.create', $competitor->id) }}" method="POST">
    @csrf
    <input type="hidden" name="rank" value="{{ $competitor->position }}">
    <div class="question-card"
         data-side-category-id="{{ $competitor->sideCategory->id ?? '' }}"
         data-side-category-name="{{ $competitor->sideCategory->name ?? '' }}"
         data-read-category-id="{{ $competitor->readCategory->id ?? '' }}"
         data-read-category-name="{{ $competitor->readCategory->name ?? '' }}"
         data-age-category-id="{{ $competitor->ageCategory->id ?? '' }}"
         data-age-category-name="{{ $competitor->ageCategory->name ?? '' }}">

        <div class="question-header" onclick="toggleDetails(this)">
            <span><span>Place :</span> <strong>{{ $competitor->position }}</strong></span>


              <span class="rankstatus">Status:

                @if (!$alreadyRanked)
                <p class="rankstatus1">Not Sent</p>

                @else
                <p style=" font-weight:100;  ;color:
                @if($competitor->ranking->status === 'pending')
                    blue
                @elseif($competitor->ranking->status === 'announced')
                    green
                @endif;
                text-transform: capitalize;">
                {{ ucfirst($competitor->ranking->status) }}
            </p>

                @endif

                </span>
                            <span class="arrow"><i class="fas fa-chevron-down"></i></span>
        </div>

        <div class="question-details">
            <p><strong>Name :</strong> <span>{{ $competitor->full_name }}</span></p>
            <p><strong>ID Card Number :</strong> <span>{{ $competitor->id_card_number }}</span></p>
            <p><strong>Address :</strong> <span>{{ $competitor->address }}</span></p>
            <p><strong>Island/City :</strong> <span>{{ $competitor->island_city }}</span></p>
            <p><strong>School Name :</strong> <span>{{ $competitor->school_name ?? 'N/A' }}</span></p>
            <p><strong>Parent Name :</strong> <span>{{ $competitor->parent_name }}</span></p>
            <p><strong>Phone Number :</strong> <span>{{ $competitor->phone_number }}</span></p>
            <p><strong>Competition Name :</strong> <span>{{ $competitor->competition->main_name ?? 'N/A' }}</span></p>
            <p><strong>Age Category :</strong> <span>{{ $competitor->ageCategory->name ?? 'N/A' }}</span></p>
            <p><strong>Reading side :</strong> <span>{{ $competitor->sideCategory->name ?? 'N/A' }}</span></p>
            <p><strong>Reading type :</strong> <span>{{ $competitor->readCategory->name ?? 'N/A' }}</span></p>
            <p><strong>Number of Questions :</strong> <span>{{ $competitor->number_of_questions }}</span></p>

            @foreach ($competitor->results as $result)
                <p><strong>{{ $result->pointCategory->name ?? 'Point Category name' }} :</strong>
                    <span>{{ $result->total_points }}/{{ $result->gained_points }}</span></p>
            @endforeach

            <p><strong>Total # of Point :</strong> <span>{{ $totalPoints }}/{{ $gainedPoints }}</span></p>

            @if ($alreadyRanked)
                <button class="btn btn-secondary" type="button" disabled>Already Sent</button>
            @else
                <button class="btn btn-success send-btn" type="submit">Submit</button>
            @endif
        </div>
    </div>
</form>

            @endforeach
        </div>
    </div>

    <style>
  .question-card {
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 15px 0;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #ddd;
    }.question-header {
        background-color: #fff;
        padding: 0.5rem;
        font-size: 1.2em;
        font-weight: bold;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        border-bottom: 1px solid #ddd;
    }

    .question-header .arrow {
        cursor: pointer;
        font-size: 1.2em;
        color: #666;
    }

    .question-details {
        padding: 1rem;
        background-color: #fff;
        display: none;
    }

    .question-card.active .question-details {
        display: block;
    }

    .question-details p {
        display: flex;
        justify-content: space-between;
        margin: 5px 0;
        font-size: 14px;
        line-height: 1.5;
        color: #333;
    }

    .question-details p strong {
        flex: 1; /* Align to the left */
        text-align: left;
        font-weight: bold;
        color: #000;
    }

    .question-details p span {
        flex: 1; /* Align to the right */
        text-align: right;
        color: #009f79; /* Dynamic text color */
    }
        .question-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn {
            font-size: 1em;
            padding: 8px 20px;
            border-radius: 5px;
        }

        .send-btn {
            font-size: 1.2em;
            padding: 10px 25px;
            border-radius: 6px;
            background-color: #4CAF50;
            color: var(--primary-color);
            border: none;
            cursor: pointer;
        }

        .send-btn:hover {
            background-color: #45a049;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .send-btn.d-none.d-md-block {
                display: none;
            }
        }
    </style>

    <style>
        .filter-group {
            margin-bottom: 20px;
        }

        .filter-group select {
            margin-right: 15px;
        }


        .btn {
            font-size: 1em;
            padding: 8px 20px;
            border-radius: 5px;
        }

        .send-btn {
            font-size: 1.2em;
            padding: 10px 25px;
            border-radius: 6px;
            background-color: #4CAF50;
            color: var(--primary-color);
            border: none;
            cursor: pointer;
        }

        .send-btn:hover {
            background-color: #45a049;
        }
    </style>
      <style>
        /* Body Styling */
    body {

      background-color: #f9f9f9;
      display: flex;
      flex-direction: column;
      min-height: 100vh; /* Ensure body takes full height of the screen */
      padding: 0; /* Remove default padding */
    }

    /* Container Styling */
    .container {
      flex-grow: 1; /* Allow the content to expand and fill available space */
      padding-bottom: 100px; /* Add space at the bottom for footer */
    }

    /* Footer Styling */
    footer {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      /* background-color: #f1f1f1; Footer background color */
      padding: 10px;
      text-align: center;
      margin-bottom: 10px; /* Margin above the footer */
    }

      </style>
      {{-- @include('includes.footer') --}}
@endsection

@section('scripts')
    <script>
        // Filter competitors based on selected criteria
        function filterCompetitors() {
            const sideCategory = document.getElementById('sideCategoryFilter').value.toLowerCase();
            const readCategory = document.getElementById('readCategoryFilter').value.toLowerCase();
            const ageCategory = document.getElementById('ageCategoryFilter').value.toLowerCase();

            // Get all competitor cards
            const competitors = document.querySelectorAll('.question-card');

            competitors.forEach(function(card) {
                // Fetch data attributes
                const cardSideCategoryId = card.getAttribute('data-side-category-id');
                const cardSideCategoryName = card.getAttribute('data-side-category-name').toLowerCase();
                const cardReadCategoryId = card.getAttribute('data-read-category-id');
                const cardReadCategoryName = card.getAttribute('data-read-category-name').toLowerCase();
                const cardAgeCategoryId = card.getAttribute('data-age-category-id');
                const cardAgeCategoryName = card.getAttribute('data-age-category-name').toLowerCase();

                // Determine matches for each category
                const matchesSideCategory = sideCategory ?
                    (cardSideCategoryId == sideCategory || cardSideCategoryName.includes(sideCategory)) :
                    true;
                const matchesReadCategory = readCategory ?
                    (cardReadCategoryId == readCategory || cardReadCategoryName.includes(readCategory)) :
                    true;
                const matchesAgeCategory = ageCategory ?
                    (cardAgeCategoryId == ageCategory || cardAgeCategoryName.includes(ageCategory)) :
                    true;

                // Show or hide the card based on matches
                if (matchesSideCategory && matchesReadCategory && matchesAgeCategory) {
                    card.style.display = 'block'; // Show the card
                } else {
                    card.style.display = 'none'; // Hide the card
                }
            });
        }

        // Add event listeners to dropdowns to filter competitors dynamically
        document.getElementById('sideCategoryFilter').addEventListener('change', filterCompetitors);
        document.getElementById('readCategoryFilter').addEventListener('change', filterCompetitors);
        document.getElementById('ageCategoryFilter').addEventListener('change', filterCompetitors);
    </script>




    <script>
        // Handle Send button click
        function sendCompetitor(competitorId) {
            alert('Competitor with ID ' + competitorId + ' sent!');
            // Here you can send the competitor data to the server via AJAX or redirect as needed
        }

        // Toggle the dropdown and the Send button's position
        function toggleDetails(headerElement) {
            const detailsElement = headerElement.nextElementSibling;
            const sendButton = detailsElement.querySelector('.send-btn');

            if (detailsElement.style.display === "none" || detailsElement.style.display === "") {
                detailsElement.style.display = "block";
                sendButton.classList.remove('d-none');
            } else {
                detailsElement.style.display = "none";
                sendButton.classList.add('d-none');
            }
        }
    </script>
@endsection





















