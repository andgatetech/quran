<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competition Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=notifications_active" />

    <style>
        .material-symbols-outlined {
          font-variation-settings:
          'FILL' 0,
          'wght' 400,
          'GRAD' 0,
          'opsz' 24
        }
        </style>
    <style>
         body {
position:relative;

            background-color: #f1f6f6;
            margin: 0;
            padding: 0;
        }

        /* Full-Width Header */
        .header {
            background-color: var(--secondary-color);
            color: var(--primary-color);
            padding: 20px 0;
            text-align: center;
            width: 100%;
        }

        .header h1,
        .header h2 {
            margin: 0;
            font-weight: normal;
        }

        /* Container for the form with narrower width */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Welcome Section */
        .welcome {
            display: flex;
            justify-content: left;
            align-items: center;
            margin: 20px 0;
            background-color: var(--primary-color);
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .welcome img {
            width: 50px;
        }

        .welcome p {
            margin: 0;
            font-size: 18px;
            color: var(--secondary-color);
            text-align: left; margin-left: .3rem;
        }

        /* Info Card */
        .info-card {
            background-color: var(--primary-color);
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .info-card p {
            margin: 8px 0;
            font-size: 16px;
            display: flex;
            justify-content: space-between;
        }

        .info-card .title {
            font-weight: bold;
            color: var(--secondary-color);
        }

        /* Controls Section */
        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0;
            width: 100%;
            padding: 10px;
            background-color: var(--primary-color);
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .controls .label {
            font-size: 16px;
            font-weight: bold;
            color: var(--secondary-color);
            margin-right: 15px;
        }

        .controls input {
            border: none;
            background-color: #f1f6f6;
            padding: 10px;
            font-size: 18px;
            text-align: center;
            width: 50px;
            font-weight: bold;
            margin: 0 10px;
        }

        .controls button {
            background-color: var(--secondary-color);
            color: var(--primary-color);
            border: none;
            width: 40px;
            height: 40px;
            font-size: 20px;
            border-radius: 5px;
            margin: 0 5px;
        }

        .controls .bell-icon {

        }

        .material-symbols-outlined{
            font-size: 30px;
            color: var(--primary-color);
            padding:.3rem 1.2rem;
            border-radius: .4rem;
            background-color:  var(--secondary-color);
        }

        /* Submit button */
        .submit-btn {
            background-color: var(--secondary-color);
            color: var(--primary-color);
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
            margin-top: 30px;
        }



        /* Styling for smaller sections like logo and input buttons */
        .container-fluid {
            padding: 0;
        }


.btn-primary ,.active{ background-color: var(--secondary-color) !important; border:var(--secondary-color) !important ; width: 100% !important;}

    </style>
    <style>
        /* Existing styles... */
        /* Add a class to indicate active bell */
        .bell-active {
            color: #ff0000; /* Change color to red when active */
            animation: shake 0.5s infinite;
        }

        @keyframes shake {
            0% { transform: rotate(0deg); }
            25% { transform: rotate(15deg); }
            50% { transform: rotate(0deg); }
            75% { transform: rotate(-15deg); }
            100% { transform: rotate(0deg); }
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header">
        <h1>{{ $competitors->first()->competition_name ?? 'Competition Main Title' }}</h1>
        <h2>{{ $competitors->first()->competition_sub_name ?? 'Competition Sub Title' }}</h2>
    </div>

    @if ($competitors->isEmpty())
        <div class="container mt-5">
            <div class="alert alert-warning text-center" role="alert">
                <h4 class="alert-heading">No Competitors Found</h4>
                <p>No competitors have been sent yet. Please check back later or ensure that the competition has started.</p>
                <hr>
                <p class="mb-0">If you need assistance, contact the competition organizer.</p>
            </div>
        </div>
    @else
        <form action="{{ route('results.store') }}" method="POST">
            @csrf

            <!-- Main Content Container -->
            <div class="container">
                <!-- Welcome Section -->
                <div class="welcome text-center mt-4">
                    <img src="{{ asset('public/assets/img/logo.png') }}"alt="Logo" class="mb-3">
                    <p>Welcome,<br><b>Ahmad</b></p>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-custom animate__animated animate__fadeInDown" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-custom animate__animated animate__fadeInDown" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                @foreach ($competitors as $competitor)
                    <!-- Check if the competitor has already been allotted -->
                    @if ($competitor->already_allotted)
                        <div class="container mt-5">
                            <div class="alert alert-warning text-center" role="alert">
                                <h4 class="alert-heading">Competitor Allotted Points By You Successfully!</h4>
                                <p>This competitor has already been allotted points. Please check the existing results.</p>
                                <hr>
                                <p class="mb-0">If you need assistance, contact the competition organizer.</p>
                            </div>
                        </div>
                    @else
                        <!-- Info Card for each competitor -->
                        <input type="hidden" name="competitor_id" value="{{ $competitor->competitor_id }}">
                        <input type="hidden" name="competition_id" value="{{ $competitor->competition_id }}">

                        <div class="info-card">
                            <p><span class="title">Competition ID:</span> <span>{{ $competitor->competition_id }}</span></p>
                            <p><span class="title">Competitor ID:</span> <span>{{ $competitor->competitor_id }}</span></p>
                            <p><span class="title">Name:</span> <span>{{ $competitor->full_name }}</span></p>
                            <p><span class="title">ID Card Number:</span> <span>{{ $competitor->id_card_number }}</span></p>
                            <p><span class="title">Address:</span> <span>{{ $competitor->address }}</span></p>
                            <p><span class="title">Island / City:</span> <span>{{ $competitor->island_city }}</span></p>
                            <p><span class="title">School:</span> <span>{{ $competitor->school_name ?? 'Not Provided' }}</span></p>
                            <p><span class="title">Parent:</span> <span>{{ $competitor->parent_name }}</span></p>
                            <p><span class="title">Phone Number:</span> <span>{{ $competitor->phone_number }}</span></p>
                            <p><span class="title">Competition Name:</span> <span>{{ $competitor->competition_name }}</span></p>
                            <p><span class="title">Age Category:</span> <span>{{ $competitor->ageCategory->name ?? 'N/A' }}</span></p>
                            <p><span class="title">Side Category:</span> <span>{{ $competitor->sideCategory->name ?? 'N/A' }}</span></p>
                            <p><span class="title">Read Category:</span> <span>{{ $competitor->readCategory->name ?? 'N/A' }}</span></p>
                            <p><span class="title">Number of Questions:</span> <span>{{ $competitor->number_of_questions }}</span></p>

                            <div class="content">
                                <div id="questions-container">
                                    <p>Loading questions...</p>
                                </div>
                            </div>



                        </div>

                        @foreach ($pointCategories as $pointCategory)
                            <div class="controls border p-3 mb-3 rounded shadow-sm">
                                <p class="label font-weight-bold">{{ $pointCategory->name }}</p>
                                <div class="control-buttons d-flex align-items-center">
                                    <button type="button" class="btn btn-secondary btn-sm mr-2"
                                        onclick="updatePoints(this, {{ $pointCategory->deduction_amount }}, {{ $pointCategory->total_points }}, 'decrease')">-</button>
                                    <input type="text" class="form-control w-25 text-center" name="gained_points[]"
                                        value="{{ $pointCategory->total_points }}" readonly>
                                    <button type="button" class="btn btn-secondary btn-sm ml-2"
                                        onclick="updatePoints(this, {{ $pointCategory->deduction_amount }}, {{ $pointCategory->total_points }}, 'increase')" disabled>+</button>
                                </div>
                            </div>
                            <input type="hidden" name="point_category_id[]" value="{{ $pointCategory->id }}">
                            <input type="hidden" name="total_points[]" value="{{ $pointCategory->total_points }}">
                        @endforeach

                        <div class="controls text-center mt-3">
                            <p class="label">Bell</p>
                            <div class="bell-icon">
                                <span
                                    id="bell-{{ $competitor->competitor_id }}"
                                    class="material-symbols-outlined"
                                    onclick="triggerBell({{ $competitor->competitor_id }}, {{ $competitor->competition_id }})"
                                    style="cursor: pointer;">
                                    notifications_active
                                </span>
                            </div>
                        </div>


                        <input type="hidden" name="judge_id" value="{{ $judge_id }}">

                        <button type="submit" class="btn btn-primary mt-4">Submit Results</button>
                    @endif

                @endforeach
            </div>

        </form>
    @endif
    @include('includes.footer')


</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const questionContainer = document.getElementById('questions-container');

        // Function to fetch questions from the server via AJAX
        function fetchQuestions() {
            $.ajax({
                url: '{{ route('announcement.fetch-questions') }}', // Update with the correct route
                method: 'GET',
                success: function (questions) {
                    // Clear the existing questions
                    questionContainer.innerHTML = '';

                    // If no questions are found, show a message
                    if (questions.length === 0) {
                        questionContainer.innerHTML = '<p>No questions available currently.</p>';
                        return;
                    }

                    // Iterate over the questions and render them
                    questions.forEach(question => {
                        const questionDiv = document.createElement('div');
                        questionDiv.className = 'question-item';
                        questionDiv.innerHTML = `
                            <div class="row">
                                <p><span class="title">Question Title:</span> <span>${question.question_name}</span></p>
                            </div>
                            <div class="row">
                                <p><span class="title">Hardness:</span> <span>${question.hardness || 'N/A'}%</span></p>
                            </div>
                        `;
                        questionContainer.appendChild(questionDiv);
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching questions:', error);
                    questionContainer.innerHTML = '<p>Error loading questions. Please try again later.</p>';
                }
            });
        }

        // Fetch questions initially and every 3 seconds
        fetchQuestions();
        setInterval(fetchQuestions, 5000);
    });
</script>
<script>

    function updatePoints(button, deductionAmount, maxValue, operation) {
        // Get the input field associated with this button
        let input = operation === 'increase' ?
            button.previousElementSibling :
            button.nextElementSibling;

        // Parse the current value and deduction amount
        let currentValue = parseFloat(input.value);
        let adjustment = parseFloat(deductionAmount);

        // Update the value based on the operation
        if (operation === 'increase' && currentValue + adjustment <= maxValue) {
            input.value = (currentValue + adjustment).toFixed(2); // Increase
        } else if (operation === 'decrease' && currentValue - adjustment >= 0) {
            input.value = (currentValue - adjustment).toFixed(2); // Decrease
        }

        // Enable/disable buttons based on the updated value
        toggleButtonState(button, input, maxValue);
    }

    /**
     * Toggle the state of increment and decrement buttons
     * @param {HTMLElement} button - The button that triggered the event
     * @param {HTMLElement} input - The associated input field
     * @param {number} maxValue - The maximum allowable value
     */
    function toggleButtonState(button, input, maxValue) {
        // Parse the current value
        let currentValue = parseFloat(input.value);

        // Get the increment and decrement buttons
        let incrementButton = button.closest('.control-buttons').querySelector('button:last-child');
        let decrementButton = button.closest('.control-buttons').querySelector('button:first-child');

        // Disable increment button if max value is reached
        if (currentValue >= maxValue) {
            incrementButton.disabled = true;
        } else {
            incrementButton.disabled = false;
        }

        // Disable decrement button if value is zero
        if (currentValue <= 0) {
            decrementButton.disabled = true;
        } else {
            decrementButton.disabled = false;
        }
    }
</script>

<script>
    function deactivateBell(competitorId, competitionId) {
        const bellIcon = document.getElementById(`bell-${competitorId}`);
        const judgeId = {{ session('judge_id') }}; // Get the judge ID from the session

        fetch('{{ route('bell.deactivate') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    competitor_id: competitorId,
                    competition_id: competitionId,
                    judge_id: judgeId // Include judge_id in the request
                }),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data.message); // Success message from backend
                // Optionally, show a toast or alert
                // alert(data.message);
            })
            .catch(error => {
                console.error('Error deactivating bell:', error);
                // Optionally, notify the user
            })
            .finally(() => {
                // Re-enable the bell icon regardless of success or failure
                bellIcon.classList.remove('bell-active');
                bellIcon.style.pointerEvents = 'auto';
            });
    }

    function triggerBell(competitorId, competitionId) {
        const bellIcon = document.getElementById(`bell-${competitorId}`);
        const judgeId = {{ session('judge_id') }}; // Get the judge ID from the session

        // Disable the bell icon to prevent multiple clicks
        bellIcon.classList.add('bell-active');
        bellIcon.style.pointerEvents = 'none'; // Prevent further clicks

        fetch('{{ route('bell.trigger') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    competitor_id: competitorId,
                    competition_id: competitionId,
                    judge_id: judgeId // Include judge_id in the request
                }),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data.message); // Success message from backend
                // Optionally, show a toast or alert
                // alert(data.message);
            })
            .catch(error => {
                console.error('Error triggering bell:', error);
                // Re-enable the bell icon in case of error
                bellIcon.classList.remove('bell-active');
                bellIcon.style.pointerEvents = 'auto';
            });

        // Set a timer to deactivate the bell after 5 seconds
        setTimeout(() => {
            deactivateBell(competitorId, competitionId);
        }, 5000);
    }
</script>



</html>
