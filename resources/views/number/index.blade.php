@php

    use App\Models\Competitor;
    use App\Models\QuestionChild;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Template</title>
    @include('includes.head')

    <style>
         body {
position:relative;

            min-height: 60vw;
            background-color: #f4f4f4;
            /* margin: 0; */
            align-items: center !important;
            justify-content: start  !important;
        }

        .competition-main, .welcome-box {
            border-radius: 25px;
            padding: 15px;
            text-align: center;
            font-weight: 500;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .competition-main {
            background-color: #2ab795;
            color: var(--primary-color);
        }

        .welcome-box {
            background-color: var(--primary-color);
            color: #2ab795;
            margin-bottom: 30px;
        }

        .card-container {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            padding: 20px;
            scrollbar-width: thin;
            scrollbar-color: #ccc #f4f4f4;
        }

        .card-container::-webkit-scrollbar {
            height: 8px;
        }

        .card-container::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 10px;
        }

        .card-container::-webkit-scrollbar-track {
            background-color: #f4f4f4;
        }

        .card {
            flex: 0 0 auto;
            width: 150px;
            height: 250px;
            background-color: var(--primary-color);
            border: 1px solid #ddd;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            cursor: pointer;
            transition: transform 0.6s ease, z-index 0.2s ease;
            transform-style: preserve-3d;
        }

        .card .front, .card .back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 15px;
            text-align: center;
        }

        .card .front {
            background-color: #4caf50;
            color: var(--primary-color);
            font-size: 24px;
            font-weight: bold;
        }

        .card .back {
            background-color: #f9f9f9;
            color: #333;
            transform: rotateY(180deg);
            font-size: 18px;
            padding: 10px;
        }

        .card .back input[type="checkbox"] {
            position: absolute;
            top: 10px;
            right: 10px;
            transform: scale(1.5);
        }

        .card:hover {
            transform: scale(1.05);
            z-index: 5;
        }

        .card.last {
            transform: scale(1.2);
            z-index: 10;
        }

        .card.show {
            transform: rotateY(180deg);
        }

        .form1 {
            margin: 0;
            padding: 0;
            width: 100%;
            display: flex;
            justify-content: center;
        }
        .container{margin-bottom: 6rem;}
        .checkbox{visibility: hidden;}
    </style>
<style>
    #countdown-timer {
        position: fixed;
        top: 10px;
        right: 10px;
        background-color: var(--secondary-color); /* Attractive orange color */
        color: #fff; /* White text for contrast */
        padding: 10px 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);

        text-align: center;
        z-index: 1000; /* Ensure it appears above everything */
        font-size: 16px;
        animation: fadeIn 0.5s ease-in-out;
    }

    .countdown-number {
        font-size: 24px;
        font-weight: bold;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
</head>

<body>
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


    @if (!$competitor_id)

    <div class="alert  text-center" role="alert">
        <div class="competition-main">
            <h4 class="mb-1">No ongoing competitor found</h4>
        </div>
        <div class="container mt-5">
            <div class="alert alert-warning text-center competition-main" role="alert">
                <h4 class="alert-heading">Why!</h4>
                <p>There Is no ngoing Competitor In the record ,Sent By  calling screen</p>
                <hr>
                <p class="mb-0">If you need assistance, please contact the competition organizer.</p>
            </div>
        </div>
    </div>
    @else



    @php
    $competitor_id = $questions->first()->competitor_id ?? null;
    $competition_id = $questions->first()->competition_id ?? null;

    // Fetch the number of questions already answered by the competitor
    $number_of_questions_done = \App\Models\QuestionChild::where('competitor_id', $competitor_id)
        ->where('competition_id', $competition_id)
        ->count();

    $competitor = \App\Models\Competitor::find($competitor_id);
    $number_of_questions = $competitor->number_of_questions ?? 0;
@endphp
@if ($number_of_questions_done >= $number_of_questions)
<div class="alert  text-center" role="alert">
    <div class="competition-main">
        <h4 class="mb-1">No Questions Found | No Records to Display</h4>
    </div>
    <div class="container mt-5">
        <div class="alert alert-warning text-center competition-main" role="alert">
            <h4 class="alert-heading">Why!</h4>
            <p>Questions cannot be displayed at the moment. This may be because the candidate has reached the maximum question limit, or there are no questions available that match the competitor's requirements, such as reading level, side, or age category.</p>
            <hr>
            <p class="mb-0">If you need assistance, please contact the competition organizer.</p>
        </div>
    </div>
</div>

@else
    @if ($questions->isNotEmpty())
        <div class="container mt-5">
            <!-- Competition Main Box -->
            <div class="competition-main">
                <h4 class="mb-1">Competition Main Name</h4>
                <h5>Competition Sub Name</h5>
            </div>

            <!-- Welcome Box -->
            <div class="welcome-box">
                <h5 class="mb-1">Welcome, {{ $questions->first()->full_name }}</h5>
                <h6>Best Of Luck...</h6>
            </div>

            <!-- Cards Section -->
            <form action="{{ route('question.store') }}" method="POST" class="form1">
                @csrf
                <div class="card-container">
                    @foreach ($questions as $question)
                        <div class="card {{ $loop->last ? 'last' : '' }}" data-question="{{ $question->question_name }}">
                            <div class="front">{{ $loop->iteration }}</div>
                            <div class="back">
                                {{ $question->question_name }}
                                <input type="checkbox" name="question_id[]" value="{{ $question->question_id }}" id="card-{{ $loop->iteration }}" class="checkbox" data-question="{{ $question->id }}">
                                <input type="hidden" value="{{ $question->competitor_id }}" name="competitor_id">
                                <input type="hidden" value="{{ $question->competition_id }}" name="competition_id">
                            </div>
                        </div>
                    @endforeach
                </div>
            </form>

        </div>
    @else
        <div class="competition-main">
            <h4 class="mb-1">No Question Matched</h4>
        </div>
        <div class="container mt-5">
            <div class="alert alert-warning text-center competition-main" role="alert">
                <h4 class="alert-heading">No Record Found!</h4>
                <p>Questions cannot be displayed at the moment. Please wait and try again later.</p>
                <hr>
                <p class="mb-0">If you need assistance, please contact the competition organizer.</p>
            </div>
        </div>
    @endif
@endif
@endif


<div id="countdown-timer" style="display: none;">
    <span class="countdown-number"></span>
    <p>Submitting in <span id="countdown-seconds"></span> seconds...</p>
</div>


<script>document.querySelectorAll('.card').forEach((card) => {
    const front = card.querySelector('.front');
    const back = card.querySelector('.back');
    const checkbox = back.querySelector('input[type="checkbox"]');
    let flipTimeout; // Variable to track the timeout for submission
    let countdownInterval; // Variable to track the countdown interval

    // Initialize visibility
    front.style.display = 'flex';
    back.style.display = 'none';

    // Reference to the countdown timer elements
    const countdownTimer = document.getElementById('countdown-timer');
    const countdownSeconds = document.getElementById('countdown-seconds');

    // Function to start the countdown timer
    function startCountdown(seconds) {
        let timeLeft = seconds;
        countdownSeconds.textContent = timeLeft;
        countdownTimer.style.display = 'block'; // Show the countdown timer

        countdownInterval = setInterval(() => {
            timeLeft -= 1;
            countdownSeconds.textContent = timeLeft;

            if (timeLeft <= 0) {
                clearInterval(countdownInterval);
                countdownTimer.style.display = 'none'; // Hide the countdown timer
            }
        }, 1000);
    }

    // Click event for flipping the card
    card.addEventListener('click', (e) => {
        // Prevent multiple clicks on the checkbox itself
        if (e.target === checkbox) return;

        const isFlipped = card.classList.contains('show');

        // Show confirmation message before flipping
        const confirmSubmit = confirm("Are you sure you want to flip this card?");
        if (!confirmSubmit) {
            // Stop the card from flipping if the user cancels
            return;
        }

        // Reset all other cards and clear existing timeouts
        document.querySelectorAll('.card').forEach((c) => {
            c.classList.remove('show');
            c.querySelector('.front').style.display = 'flex';
            c.querySelector('.back').style.display = 'none';
        });
        clearTimeout(flipTimeout);
        clearInterval(countdownInterval); // Clear any running countdown
        countdownTimer.style.display = 'none'; // Hide the countdown timer if it was running

        // Flip the current card
        card.classList.add('show');

        // Manage visibility during and after animation
        card.addEventListener('transitionend', () => {
            if (card.classList.contains('show')) {
                front.style.display = 'none';
                back.style.display = 'flex';

                // Start a 5-second countdown timer and submission
                startCountdown(5);
                flipTimeout = setTimeout(() => {
                    checkbox.checked = true; // Automatically check the checkbox
                    checkbox.form.submit(); // Submit the form
                }, 5000); // 5-second delay
            } else {
                front.style.display = 'flex';
                back.style.display = 'none';
            }
        });
    });
});


</script>














































{{-- <script>
    document.querySelectorAll('.card').forEach((card) => {
        const front = card.querySelector('.front');
        const back = card.querySelector('.back');
        const checkbox = back.querySelector('input[type="checkbox"]');

        // Initialize visibility
        front.style.display = 'flex';
        back.style.display = 'none';

        // Click event for flipping the card
        card.addEventListener('click', (e) => {
            // Prevent multiple clicks on the checkbox itself
            if (e.target === checkbox) return;

            const isFlipped = card.classList.contains('show');

            // Reset all other cards
            document.querySelectorAll('.card').forEach((c) => {
                c.classList.remove('show');
                c.querySelector('.front').style.display = 'flex';
                c.querySelector('.back').style.display = 'none';
            });

            // Flip the current card
            if (!isFlipped) {
                card.classList.add('show');
            }

            // Manage visibility during and after animation
            card.addEventListener('transitionend', () => {
                if (card.classList.contains('show')) {
                    front.style.display = 'none';
                    back.style.display = 'flex';

                    // Wait 1 second after flip before showing confirmation
                    setTimeout(() => {
                        const confirmSubmit = alert("Are you sure you want to post?");
                        if (confirmSubmit) {
                            checkbox.checked = true; // Automatically check the checkbox
                            checkbox.form.submit(); // Submit the form
                        }
                    }, 1000); // 1 second delay
                } else {
                    front.style.display = 'flex';
                    back.style.display = 'none';
                }
            });
        });
    });
</script> --}}

    {{-- <script>
        document.querySelectorAll('.card').forEach((card) => {
            const front = card.querySelector('.front');
            const back = card.querySelector('.back');
            const checkbox = back.querySelector('input[type="checkbox"]');

            // Initialize visibility
            front.style.display = 'flex';
            back.style.display = 'none';

            // Click event for flipping the card
            card.addEventListener('click', (e) => {
                const isFlipped = card.classList.contains('show');

                // Flip the card if not already flipped
                if (!isFlipped) {
                    // Reset all other cards
                    document.querySelectorAll('.card').forEach((c) => {
                        c.classList.remove('show');
                        c.querySelector('.front').style.display = 'flex';
                        c.querySelector('.back').style.display = 'none';
                    });

                    card.classList.add('show');
                } else {
                    // If already flipped, toggle the checkbox when clicking anywhere
                    if (e.target !== checkbox) {
                        checkbox.checked = !checkbox.checked;

                        // Submit the form only if the checkbox is checked
                        if (checkbox.checked) {
                            checkbox.form.submit();
                        }
                    }
                }
            });

            // Manage visibility during and after animation
            card.addEventListener('transitionend', () => {
                if (card.classList.contains('show')) {
                    front.style.display = 'none'; // Hide front after flip
                    back.style.display = 'flex'; // Show back after flip
                } else {
                    front.style.display = 'flex'; // Show front after flip back
                    back.style.display = 'none'; // Hide back after flip back
                }
            });

            // Checkbox change event to submit the form on check
            checkbox.addEventListener('change', function() {
                // Only submit if the checkbox is checked (not unchecked)
                if (this.checked) {
                    this.form.submit();
                }
            });
        });
    </script> --}}
  @include('includes.footer')

</body>

</html>
