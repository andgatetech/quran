<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competition Template</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=notifications_active" />

    <style>
        body {
            position: relative;

        }

        .header {
            background-color: var(--secondary-color);
            ;
            color: var(--primary-color);
            text-align: center;
            padding: 20px;
            border-radius: .8rem;
        }

        .content {
            border: 1px solid var(--secondary-color);
            ;
            border-top: none;
            padding: 20px;
            border-radius: 0 0 10px 10px;
            margin-top: 1rem;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
            ;
            border-radius: .8rem;
        }

        .content .label {
            font-weight: bold;
            text-align: left;
            font-weight: 300;
        }

        .content .value {
            color: var(--secondary-color);
            font-weight: bold;
            text-align: right;
            font-weight: 300;

        }

        .row {
            margin-bottom: 10px;
        }
    </style>
    <style>
        .sponsored-header {
            background-color: var(--secondary-color);
            ;
            color: var(--primary-color) !important;
            text-align: center;
            padding: .5rem !important;
            font-size: .9rem !important;
            ;
            border-radius: 1rem;
            margin-bottom: 5rem;


        }

        .sponsored-content {
            margin-top: 1rem;

            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
            ;
            border: 1px solid var(--secondary-color);
            ;
            border-top: none;
            border-radius: 1rem;
            padding: 20px;
            background-color: var(--primary-color);
        }




        .pagination {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .pagination span {
            width: 3rem;
            height: 1.5rem;
            background-color: #666;
            border-radius: 1rem;
            display: inline-block;
            cursor: pointer;
        }

        .pagination span.active {
            background-color: var(--secondary-color);
            ;
        }

        @media (max-width: 576px) {
            .slider-container img {
                max-width: 100px;
            }
        }
    </style>
    <style>
        .custom-button {
            display: inline-block;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            text-align: center;
            line-height: 50px;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        /* Button with white background and green border */
        .custom-button-white {
            background-color: #fff;
            border: 2px solid var(--secondary-color);
            ;
            color: var(--secondary-color);
            ;
        }

        .custom-button-white:hover {
            background-color: var(--secondary-color);
            ;
            color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Button with green background */
        .custom-button-green {
            background-color: var(--secondary-color);
            ;
            color: #fff;
            border: none;
        }

        .custom-button-green:hover {
            background-color: var(--secondary-color);
            ;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
    <style>
        /* Modal Container */
        .bell-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Semi-transparent background */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            display: none;
            /* Initially hidden */
        }

        /* Modal Content */
        .bell-modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 300px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Bell Icon */
        .bell-icon {
            background-color: var(--secondary-color);
            color: #fff;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 10px auto;
        }

        .bell-icon i {
            font-size: 30px;
        }

        /* Bell Text */
        .bell-text p {
            margin: 0;
            font-size: 16px;
            color: var(--secondary-color);
            font-weight: bold;
        }

        .bell-text span {
            font-size: 16px;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container mt-5 "style="background-color: #fff;">



        @foreach ($competitors as $competitor)
            <div class="header">
                <h2>{{ $competitor->competition_main_name }}</h2>
                <h5>{{ $competitor->competition_sub_name }}</h5>
            </div>








            <div id="bell-announcements" class="bell-modal">
                <div class="bell-modal-content">
                    <div class="bell-icon">
                        <span
                        class="material-symbols-outlined"
                     >
                        notifications_active
                    </span>                    </div>
                    <div class="bell-text">
                        <p><strong>Bell Alert</strong></p>
                        <p id="judge-name"></p>
                    </div>
                </div>
            </div>


            <script>
                function fetchActiveBells() {
                    fetch('{{ route('announcement.bells') }}')
                        .then(response => response.json())
                        .then(data => {
                            const bellModal = document.getElementById('bell-announcements');
                            const judgeNameElement = document.getElementById('judge-name');

                            if (data.length === 0) {
                                // Hide modal if there are no active bells
                                bellModal.style.display = 'none';
                            } else {
                                // Display modal for the first active bell
                                const notification = data[0]; // Assuming one notification at a time
                                judgeNameElement.textContent = `Judge: ${notification.judge_name}`; // Use judge_name instead of competitor_name
                                bellModal.style.display = 'flex'; // Show the modal
                            }
                        })
                        .catch(error => console.error('Error fetching bells:', error));
                }

                // Fetch active bells every 5 seconds
                setInterval(fetchActiveBells, 500);

                // Close modal when clicking outside
                document.addEventListener('click', function (event) {
                    const bellModal = document.getElementById('bell-announcements');
                    if (!bellModal.contains(event.target)) {
                        bellModal.style.display = 'none';
                    }
                });
            </script>












            <div class="content" style="background-color: #fff;">
                <div class="row">
                    <div class="col-6 label">Competitor Name:</div>
                    <div class="col-6 value">{{ $competitor->full_name }}</div>
                </div>
                <div class="row">
                    <div class="col-6 label">Address:</div>
                    <div class="col-6 value">{{ $competitor->address }}</div>
                </div>
                <div class="row">
                    <div class="col-6 label">Island / City:</div>
                    <div class="col-6 value">{{ $competitor->island_city }}</div>
                </div>
                <div class="row">
                    <div class="col-6 label">Age Category:</div>
                    <div class="col-6 value">{{ $competitor->ageCategory->name ?? 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="col-6 label">Side Category:</div>
                    <div class="col-6 value">{{ $competitor->sideCategory->name ?? 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="col-6 label">Read Category:</div>
                    <div class="col-6 value">{{ $competitor->readCategory->name ?? 'N/A' }}</div>
                </div>




                @foreach ($questions as $question)
                    <div class="row">
                        <div id="questions-container">

                        </div>
                    </div>
                @endforeach











            </div>
        @endforeach
    </div>


    <style>
        .container {
            width: 100%;
            overflow: hidden;
            /* Hide the overflow for a seamless effect */
            background: #fff;
            padding: 10px 0;
        }

        .sponsored-header {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        #sponsorSlider {
            display: flex;
            gap: 100px;
            animation: scroll 10s linear infinite;
            /* Smooth and continuous scrolling */

        }

        #sponsorSlider img {
            height: 160px;
            /* Adjust height as needed */
            flex-shrink: 0;
        }

        /* Keyframes for smooth scrolling */
        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }
    </style>

    <style>
        .container {
            width: 90%;
            margin: auto;
            text-align: center;

        }

        .sponsored-header {
            font-size: 1.5rem;
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
        }

        .slider-container {}

        .slider-container img {}



        .slider-container {
            display: flex;
            gap: 15px;
            overflow-x: hidden;
            scroll-snap-type: x mandatory;
            padding: 10px 0;
            width: 50rem;
            height: 8rem;


            display: flex;
            overflow: hidden;
            width: 100%;
            position: relative;
            gap: 10px;
        }

        .slider-container img {
            flex-shrink: 0;
            width: 200px;
            /* Adjust as needed */
            height: auto;
            border-radius: 10px;
            flex: 0 0 calc(25% - 15px);
            /* Show 4 images at a time */
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Crop images if needed */
            border-radius: 8px;
            /* Rounded corners */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            scroll-snap-align: center;
            /* Center snapping */
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
            !important;


        }

        .pagination {
            margin-top: 15px;
        }

        .pagination span {
            display: inline-block;
            width: 10px;
            height: 10px;
            background-color: white;
            margin: 0 5px;
            border-radius: 50%;
            cursor: pointer;
        }

        .pagination .active {
            background-color: var(--secondary-color);
            ;
        }

        .containerSlide {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            height: 10rem;
            border-radius: 1rem
        }
    </style>
    <div class="container " style="height: 400px">
        <div class="sponsored-header">Sponsored By</div>
        <div class="containerSlide"style="height: 220px">
            <div id="sponsorSlider">
                @foreach ($sponsors as $sponsor)
                    <img src="{{ asset('public/'.$sponsor->logo) }}" alt="{{ $sponsor->name }}"
                        style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;; border-radius:.7rem;margin-top:2rem;">
                @endforeach
                <!-- Duplicate the images for seamless looping -->
                @foreach ($sponsors as $sponsor)
                    <img src="{{ asset('public/'.$sponsor->logo) }}" alt="{{ $sponsor->name }}"
                        style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;; border-radius:.7rem;margin-top:2rem;">
                @endforeach
            </div>


        </div>

    </div>



























    <div class="container mt-5" style="background-color: #fff;">
        <div class="d-flex gap-3 justify-content-end">
            <!-- Button 1 -->
            <a href="{{ route('announcement.index') }}" class="custom-button custom-button-green">S1</a>

            <!-- Button 2 -->
            <a href="{{ route('announcement.winners') }}" class="custom-button custom-button-white">S2</a>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>


























    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

{{-- <script>
    function fetchActiveBells() {
        fetch('{{ route('announcement.bells') }}')
            .then(response => response.json())
            .then(data => {
                const bellContainer = document.getElementById('bell-announcements');
                bellContainer.innerHTML = ''; // Clear previous notifications

                if (data.length === 0) {
                    bellContainer.innerHTML = '';
                } else {
                    data.forEach(notification => {
                        const div = document.createElement('div');
                        div.className = 'alert alert-info text-center';
                        div.style.marginBottom = '10px';
                        div.innerHTML = <
                            strong > $ {
                                notification.competitor_name
                            } < /strong> - The bell is ringing for <
                            strong > $ {
                                notification.competition_name
                            } < /strong>!;
                        bellContainer.appendChild(div);
                    });
                }
            })
            .catch(error => console.error('Error fetching bells:', error));
    }

    // Fetch active bells every 5 seconds
    setInterval(fetchActiveBells, 500000);
</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const questionContainer = document.getElementById('questions-container');

        // Function to fetch questions from the server
        function fetchQuestions() {
            fetch('{{ route('announcement.fetch-questions') }}')
                .then(response => response.json())
                .then(questions => {
                    // Clear existing questions
                    questionContainer.innerHTML = '';

                    // If no questions are found, show a message
                    if (questions.length === 0) {
                        questionContainer.innerHTML = '<p>No questions available currently.</p>';
                        return;
                    }

                    // Iterate over questions and render them
                    questions.forEach(question => {
                        const questionDiv = document.createElement('div');
                        questionDiv.className = 'content';
                        questionDiv.innerHTML = `
                        <div class="row">
                            <div class="col-6 label">Question Title:</div>
                            <div class="col-6 value">${question.question_name}</div>
                        </div>
                        <div class="row">
                            <div class="col-6 label">Hardness:</div>
                            <div class="col-6 value">${question.hardness}%</div>
                        </div>
                    `;
                        questionContainer.appendChild(questionDiv);
                    });
                })
                .catch(error => console.error('Error fetching questions:', error));
        }

        // Fetch questions initially and every 3 seconds
        fetchQuestions();
        setInterval(fetchQuestions, 3000);
    });
</script>


</html>
