@extends('layouts.app')

@section('content')
    <style>
        .button-group1 {
            display: block;
            gap: 10px;
            margin-bottom: 20px;
        }

        .container {
            margin-bottom: 6rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid silver;
            border-radius: 1rem;
            padding: 2rem auto;
        }

        .container1 {
            margin: 0 !important;
            padding: 0 !important;
            height: auto;
        }

        .tabs {
            margin: 0 !important;
            padding: 0 !important;
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

        .btn-outline-success1 {
            color: var(--secondary-color) !important;
            border: 1px solid var(--secondary-color) !important;
        }


        .active {
            background-color: var(--secondary-color) !important ;
            color: #ffffff !important;

        }

        .btn-outline-success1:hover {
            background-color: var(--secondary-color) !important ;
            color: #ffffff !important;
        }

        .arrow i {
            transition: transform 0.3s ease;
        }

        .fa-chevron-up {
            transform: rotate(180deg);
        }

        .fa-chevron-down {
            transform: rotate(0deg);
        }

        .question-details p {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 5px 0;
            font-size: 14px;
            line-height: 1.5;
            color: #333;
        }

        .question-details p strong {
            flex: 1;
            text-align: left;
            font-weight: bold;
            color: #000;
        }

        .question-details p span {
            flex: 1;
            text-align: right;
            color: var(--secondary-color) !important;;
            /* Dynamic text color */
        }

        .send-btn {
            display: block;
            margin: 15px auto;
            padding: 10px 25px;
            font-size: 14px;
            background-color: var(--secondary-color) !important ;
            ;
            ;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .send-btn:hover {
            background-color: var(--secondary-color) !important ;
        }

        .filter-group {
            margin-bottom: 20px;
        }

        .filter-group select {
            margin-right: 15px;
        }

        .question-card {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 15px 0;
            border-radius: 8px;
            overflow: hidden;
        }

        .question-header {
            background-color: white !important;
            padding: 0 !important;
            font-size: 1.2em;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .question-header .arrow {
            cursor: pointer;
        }

        .question-details {
            padding: 15px;
            background-color: white !important;
            ;
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
            background-color: var(--secondary-color) !important ;
            ;
            ;
            color: var(--primary-color);
            border: none;
            cursor: pointer;
        }

        .send-btn:hover {
            background-color: var(--secondary-color) !important ;
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
            background-color: var(--secondary-color) !important ;
            ;
            ;
            color: var(--primary-color);
            border: none;
            cursor: pointer;
        }

        .send-btn:hover {
            background-color: var(--secondary-color) !important ;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .send-btn.d-none.d-md-block {
                display: none;
            }
        }
    </style>
    <header class="header">
        <a class="back-btn" href="{{ route('welcome') }}"><i class="fas fa-home"></i></a>
        <h1>Competitor List</h1>
    </header>


    <div class="button-group1">




        <button class="btn btn-outline-success1  " onclick="window.location.href='{{ route('calling.performed') }}'">Performed
            List</button>
        <button class="btn btn-outline-success1 active" onclick="window.location.href='{{ route('calling.ready') }}'"> Ready
            To Perform
        </button>

        <select id="sideCategoryFilter" class="btn btn-outline-success1">
            <option value="">Select Side Category</option>
            @foreach ($sideCategories as $sideCategory)
                <option value="{{ $sideCategory->id }}">{{ $sideCategory->name }}</option>
            @endforeach
        </select>

        <select id="readCategoryFilter" class="btn btn-outline-success1">
            <option value="">Select Read Category</option>
            @foreach ($readCategories as $readCategory)
                <option value="{{ $readCategory->id }}">{{ $readCategory->name }}</option>
            @endforeach
        </select>

        <select id="ageCategoryFilter" class="btn btn-outline-success1">
            <option value="">Select Age Category</option>
            @foreach ($ageCategories as $ageCategory)
                <option value="{{ $ageCategory->id }}">{{ $ageCategory->name }}</option>
            @endforeach
        </select>
    </div>





    <div class="container">




        <!-- Competitor List -->
        <div id="competitorList">
            @foreach ($competitors as $competitor)
                <div class="question-card" data-side-category-id="{{ $competitor->sideCategory->id ?? '' }}"
                    data-side-category-name="{{ $competitor->sideCategory->name ?? '' }}"
                    data-read-category-id="{{ $competitor->readCategory->id ?? '' }}"
                    data-read-category-name="{{ $competitor->readCategory->name ?? '' }}"
                    data-age-category-id="{{ $competitor->ageCategory->id ?? '' }}"
                    data-age-category-name="{{ $competitor->ageCategory->name ?? '' }}">
                    <div class="question-header" onclick="toggleDetails(this)">
                        <span><strong>{{ $competitor->full_name }}</strong>
                            <small>({{ $competitor->id_card_number }})</small></span>
                        <span class="arrow"><i class="fas fa-chevron-down"></i></span>
                    </div>
                    <div class="question-details">
                        <p>
                            <strong>Name :</strong>
                            <span>{{ $competitor->full_name }}</span>
                        </p>
                        <p>
                            <strong>ID Card Number :</strong>
                            <span>{{ $competitor->id_card_number }}</span>
                        </p>
                        <p>
                            <strong>Address :</strong>
                            <span>{{ $competitor->address }}</span>
                        </p>
                        <p>
                            <strong>Island / City :</strong>
                            <span>{{ $competitor->island_city }}</span>
                        </p>
                        <p>
                            <strong>School :</strong>
                            <span>{{ $competitor->school_name ?? 'N/A' }}</span>
                        </p>
                        <p>
                            <strong>Parent :</strong>
                            <span>{{ $competitor->parent_name }}</span>
                        </p>
                        <p>
                            <strong>Phone Number :</strong>
                            <span>{{ $competitor->phone_number }}</span>
                        </p>
                        <p>
                            <strong>Competition Name :</strong>
                            <span>{{ $competitor->competition->name ?? 'N/A' }}</span>
                        </p>
                        <p>
                            <strong>Age Category :</strong>
                            <span>{{ $competitor->ageCategory->name ?? 'N/A' }}</span>
                        </p>
                        <p>
                            <strong>Side Category :</strong>
                            <span>{{ $competitor->sideCategory->name ?? 'N/A' }}</span>
                        </p>
                        <p>
                            <strong>Read Category :</strong>
                            <span>{{ $competitor->readCategory->name ?? 'N/A' }}</span>
                        </p>
                        <p>
                            <strong>Number of Questions :</strong>
                            <span>{{ $competitor->number_of_questions }}</span>
                        </p>
                        <form action="{{ route('competitor.updateStatus', $competitor->id) }}" method="POST">
                            @csrf
                            @method('PATCH') <!-- PATCH to update resource -->
                            <button class="btn btn-success send-btn" type="submit">Send</button>
                        </form>
                    </div>

                </div>
            @endforeach


        </div>

    </div>
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

        function toggleDetails(headerElement) {
            const detailsElement = headerElement.nextElementSibling;
            const arrowIcon = headerElement.querySelector('.arrow i');

            // Toggle the visibility of the details section
            if (detailsElement.style.display === "block") {
                detailsElement.style.display = "none";
                arrowIcon.classList.remove('fa-chevron-up');
                arrowIcon.classList.add('fa-chevron-down');
            } else {
                detailsElement.style.display = "block";
                arrowIcon.classList.remove('fa-chevron-down');
                arrowIcon.classList.add('fa-chevron-up');
            }
        }

        // Set all dropdown sections to be initially closed
        document.addEventListener("DOMContentLoaded", () => {
            const allDetailsElements = document.querySelectorAll('.question-details');
            const allArrows = document.querySelectorAll('.arrow i');

            allDetailsElements.forEach(details => {
                details.style.display = "none"; // Initially hide all details
            });

            allArrows.forEach(arrow => {
                arrow.classList.add('fa-chevron-down'); // Set initial arrow direction
            });
        });
    </script>
@endsection
