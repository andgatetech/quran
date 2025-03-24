<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Questions</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=notifications_active" />

    <style>
        /* Existing Styles */

        body {
            position: relative;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 80%;
            margin: 50px auto;
            text-align: center;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .container1 {
            max-width: 80%;
            margin: 50px auto;
            text-align: center;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            flex-direction: row;
        }

        .header {
            margin-bottom: 20px;
        }

        .header h2 {
            color: var(--secondary-color);
            ;
            margin-bottom: 5px;
        }

        .header h3 {
            color: #666;
            font-weight: normal;
        }

        .question-box {
            display: none;
            background: var(--primary-color);
            border-radius: 10px;
            /* padding: 20px; */
            text-align: left;
            margin: 20px 0;
            /* border: 1px solid #ddd; */
            box-shadow: none !important;
        }

        .ayat-text {
            display: inline;
            margin: 0 5px;
        }

        #question-tab-buttons {
            display: flex;
            align-items: center;
            justify-content: space-around;
            flex-direction: row;

        }

        #question-tab-buttons button {
            margin: 5px;
            width: 40%;
            padding: 1rem 0;
            background: var(--primary-color);

            color: var(--secondary-color);
            border: none;
            border-radius: 1rem;
            cursor: pointer;
            border: 1px solid var(--secondary-color);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-size: 1.3rem;
            margin-bottom: 2rem;

        }

        #show-question-button {
            padding: 10px 30px;
            background: var(--secondary-color);
            ;
            color: var(--primary-color);
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;

        }

        .message {
            margin-top: 20px;
            color: var(--secondary-color);
            ;
        }

        /* Hide the form and submit button completely since we submit automatically */
        form {
            display: none;
        }

        /* New Styles for Pagination Controls */
        .pagination-controls {
            margin-top: 15px;
            text-align: center;
        }

        .pagination-controls button {
            margin: 0 5px;
            padding: 5px 10px;
            background: var(--secondary-color);
            ;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            /* Explicitly set type to button */
        }

        .pagination-controls button:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .pagination-info {
            margin: 0 10px;
            font-weight: bold;
        }


        .question-tab-button.active {
            background-color: var(--secondary-color);
            /* Active background color */
            color: #fff;
            /* Active text color */
        }

        .question-tab-button:hover {
            background-color: var(--secondary-color) !important;
            color: #fff !important;
        }
    </style>
</head>

<body>

    <style>
        /* Header Styling */
        .header1 {
            background-color: var(--secondary-color);
            ;
            color: var(--primary-color);
            border-radius: 20px;
            margin-bottom: 30px;
            /* More space below the header */
            width: 100%;
        }

        .header1 h1 {
            font-size: 24px;
            /* Increased font size */
            line-height: 1.6;
        }


        .container2 {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            justify-content: center;
            max-width: 90%;
            margin: 50px auto;
            text-align: center;
            background-color: #f9f9f9;
            /* Optional background for the container */
        }

        .bell-box {
            display: flex;
            align-items: flex-start;
            justify-content: left;
            background-color: #374151;
            /* Dark background color for the boxes */
            color: #fff;
            /* White text color */
            border-radius: 10px;
            padding: 1rem .5rem;
            font-size: 1rem;
            font-weight: 500;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Add a subtle shadow */
            min-width: 9rem;
            /* Ensure a consistent minimum width */
            max-width: 12rem;
            /* Ensure a consistent minimum width */
            text-align: left;
            cursor: pointer;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .bell-box .material-symbols-outlined {
            margin-right: 10px;
            font-size: 24px;
            /* Icon size */
        }

        .bell-box:hover {
            transform: translateY(-5px);
            /* Slight lift effect on hover */
            background-color: #1f2937;
            /* Slightly darker background on hover */
        }
    </style>
    <style>
        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }
    </style>
    <div class="container1">

        <header class="header1">
            <h1>{{ $competition->main_name }}<br>{{ $competition->sub_name }}</h1>
        </header>
    </div>


    <div class="container2">
        @foreach ($Judge as $Judges)
            <div class="bell-box">
                <span class="material-symbols-outlined">notifications_active</span>
                <span>{{ $Judges->full_name }}</span>
            </div>
        @endforeach
    </div>



    <div class="container">




        <div id="question-tab-buttons">
            @foreach($questions as $question)
                <button class="question-tab-button"
                        data-question-id="{{ $question->question_id }}"
                        data-competitor-id="{{ $question->competitor_id }}">
                    {{ $question->question_name }}
                </button>
            @endforeach
        </div>
        <div id="question-container" data-competition-id="{{ session('competition_id') }}">
            @foreach ($questions as $question)

                <div class="question-box" id="question-{{ $question->question_id }}"
                    data-question-id="{{ $question->question_id }}"
                    data-competitor-id="{{ $question->competitor_id }}">
                    <h5 style="visibility:hidden;">Question: {{ $question->question_name }}</h5>

                    <style>
                        .ayat-container {
                            text-align: right;
                            direction: rtl;
                            font-family: 'Amiri', serif;

                            font-size: 24px;
                            /* Adjust font size for Quranic text */
                            line-height: 2;
                            /* Add line spacing for readability */
                            margin: 10px 0;
                            color: #333;
                            /* Set the text color */
                            background: var(--primary-color);
                            ;
                            white-space: normal; /* Prevent line wrapping */

                            /* Subtle background color for elegance */
                        }

                        .ayat-text {
                            margin: 0 5px;
                            font-weight: normal;
                            display: inline-block;

                        }

                        .ayat-number {
                            display: inline-block;
                            margin-left: 5px;
                            width: 2rem;
                            height: 2rem;
                            font-size: 18px;
                            font-weight: bold;
                            background: var(--secondary-color);
                            /* Use a color for Ayat number */
                            color: #fff;
                            border-radius: 50%;
                            text-align: center;
                            line-height: 2rem;
                            /* Vertically center the number */
                            line-height: 2rem;
                            /* Ensure the number is vertically centered */
                            font-family: 'Amiri', 'Scheherazade', serif;
                            /* Arabic numeral font */
                            unicode-bidi: bidi-override;
                            /* Ensure Arabic numbering */
                            direction: rtl;
                            /* Ensure correct numeral direction */
                        }
                    </style>
                    <div class="ayat-container">


                        @foreach ($question->ayat_details as $ayat)
                            <span class="ayat-text">
                                {{ $ayat->ayah_ar }}
                                <span class="ayat-number">
                                    @php
                                        $arabicNumerals = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
                                        $ayahNoArabic = implode(
                                            '',
                                            array_map(
                                                fn($digit) => $arabicNumerals[$digit],
                                                str_split($ayat->ayah_no_surah),
                                            ),
                                        );
                                    @endphp
                                    {{ $ayahNoArabic }}
                                </span>

                            </span>
                        @endforeach
                    </div>




                    <!-- Added Pagination Controls -->
                    <div class="pagination-controls" style="display: none;">
                        <button type="button" class="prev-page">Previous</button>
                        <span class="pagination-info">Page <span class="current-page">1</span> of <span
                                class="total-pages">1</span></span>
                        <button type="button" class="next-page">Next</button>
                    </div>
                </div>
            @endforeach
        </div>

        <button id="show-question-button">Show Question To Competitor</button>


        @if (session('message'))
            <div class="message">{{ session('message') }}</div>
        @endif
    </div>

    {{-- JavaScript for Pagination and Existing Functionality --}}
    <script>document.addEventListener('DOMContentLoaded', function () {
        const questionTabButtons = document.getElementById('question-tab-buttons');
        const questionContainer = document.getElementById('question-container');

        let currentQuestionId = "{{ session('current_question_id') ?? '' }}";
        let currentPage = parseInt("{{ session('current_page') ?? 1 }}");

        const questionPages = {};

        function setupPagination(questionBox) {
            const ayatContainer = questionBox.querySelector('.ayat-container');
            const ayatTexts = ayatContainer.querySelectorAll('.ayat-text');
            const paginationControls = questionBox.querySelector('.pagination-controls');
            const itemsPerPage = 5;
            const totalItems = ayatTexts.length;
            const totalPages = Math.ceil(totalItems / itemsPerPage);

            if (totalPages <= 1) {
                paginationControls.style.display = 'none';
                return;
            }

            let currentPageLocal = questionPages[questionBox.dataset.questionId] || 1;
            paginationControls.style.display = 'block';
            paginationControls.querySelector('.total-pages').innerText = totalPages;

            function showPage(page) {
                currentPageLocal = page;
                questionPages[questionBox.dataset.questionId] = currentPageLocal;
                const start = (page - 1) * itemsPerPage;
                const end = start + itemsPerPage;

                ayatTexts.forEach((ayat, index) => {
                    ayat.style.display = index >= start && index < end ? 'inline-block' : 'none';
                });

                paginationControls.querySelector('.current-page').innerText = currentPageLocal;
                paginationControls.querySelector('.prev-page').disabled = currentPageLocal === 1;
                paginationControls.querySelector('.next-page').disabled = currentPageLocal === totalPages;
            }

            showPage(currentPageLocal);

            const prevButton = paginationControls.querySelector('.prev-page');
            const nextButton = paginationControls.querySelector('.next-page');

            prevButton.addEventListener('click', function (event) {
                event.preventDefault();
                if (currentPageLocal > 1) {
                    showPage(currentPageLocal - 1);
                }
            });

            nextButton.addEventListener('click', function (event) {
                event.preventDefault();
                if (currentPageLocal < totalPages) {
                    showPage(currentPageLocal + 1);
                }
            });
        }

        function initializePagination() {
            const allQuestionBoxes = document.querySelectorAll('.question-box');
            allQuestionBoxes.forEach((questionBox) => {
                setupPagination(questionBox);
            });
        }

        initializePagination();

        function activateButton(questionId) {
            const allButtons = document.querySelectorAll('.question-tab-button');
            allButtons.forEach((button) => {
                button.classList.remove('active');
                button.style.backgroundColor = '';
                button.style.color = '';
            });

            const activeButton = document.querySelector(`.question-tab-button[data-question-id="${questionId}"]`);
            if (activeButton) {
                activeButton.classList.add('active');
                activeButton.style.backgroundColor = 'var(--secondary-color)';
                activeButton.style.color = '#fff';
            }
        }

        function displayQuestion(questionId, page = 1) {
            const allQuestions = document.querySelectorAll('.question-box');
            allQuestions.forEach((q) => (q.style.display = 'none'));

            const selectedQuestion = document.getElementById(`question-${questionId}`);
            if (selectedQuestion) {
                selectedQuestion.style.display = 'block';
                currentQuestionId = questionId;

                activateButton(questionId);

                setupPagination(selectedQuestion);

                const paginationControls = selectedQuestion.querySelector('.pagination-controls');
                if (paginationControls && paginationControls.style.display !== 'none') {
                    const ayatTexts = selectedQuestion.querySelectorAll('.ayat-text');
                    const itemsPerPage = 10;
                    const totalPages = Math.ceil(ayatTexts.length / itemsPerPage);
                    const desiredPage = Math.min(Math.max(page, 1), totalPages);

                    ayatTexts.forEach((ayat, index) => {
                        ayat.style.display = index >= (desiredPage - 1) * itemsPerPage && index < desiredPage * itemsPerPage ? 'inline-block' : 'none';
                    });

                    paginationControls.querySelector('.current-page').innerText = desiredPage;
                    paginationControls.querySelector('.total-pages').innerText = totalPages;
                    paginationControls.querySelector('.prev-page').disabled = desiredPage === 1;
                    paginationControls.querySelector('.next-page').disabled = desiredPage === totalPages;
                }
            }
        }

        if (currentQuestionId) {
            displayQuestion(currentQuestionId, currentPage);
        } else {
            let firstQuestion = document.querySelector('.question-box');
            if (firstQuestion) {
                firstQuestion.style.display = 'block';
                currentQuestionId = firstQuestion.dataset.questionId;
                if (!questionPages[currentQuestionId]) {
                    questionPages[currentQuestionId] = 1;
                }
            }
        }

        questionTabButtons.addEventListener('click', function (event) {
            if (event.target && event.target.matches('button.question-tab-button')) {
                const questionId = event.target.getAttribute('data-question-id');
                displayQuestion(questionId);
            }
        });

        const showQuestionButton = document.getElementById('show-question-button');
        showQuestionButton.addEventListener('click', function () {
                const visibleQuestion = Array.from(document.querySelectorAll('.question-box'))
                    .find(box => box.style.display === 'block');

                if (!visibleQuestion) {
                    alert('No question is currently visible.');
                    return;
                }

                const questionId = visibleQuestion.getAttribute('data-question-id');
                const competitorId = visibleQuestion.getAttribute('data-competitor-id');
                const competitionId = document.getElementById('question-container').getAttribute('data-competition-id');

                // Find current page
                const paginationControls = visibleQuestion.querySelector('.pagination-controls');
                let currentPage = 1;
                if (paginationControls.style.display !== 'none') {
                    currentPage = parseInt(paginationControls.querySelector('.current-page').innerText);
                }

                // Gather the text
                let questionText = visibleQuestion.querySelector('h5').innerText;
                const ayatSpans = visibleQuestion.querySelectorAll('.ayat-text');
                ayatSpans.forEach(span => {
                    if (span.style.display !== 'none') { // Include only visible Ayat
                        questionText += ' ' + span.innerHTML;
                    }
                });

                // Prepare the data to send
                const data = {
                    question_id: questionId,
                    competitor_id: competitorId,
                    competition_id: competitionId,
                    text: questionText,
                    current_page: currentPage
                };

                // Send the data via Fetch API
                fetch("{{ route('show-question-to-user') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Response data:', data); // Log the response for debugging
                    if(data.success){
                        // Show the server-provided success message
                        alert(data.message);
                    } else {
                        // Handle errors
                        if (data.errors) {
                            // Show validation errors
                            let errorMessages = '';
                            for (const [field, messages] of Object.entries(data.errors)) {
                                errorMessages += `${field}: ${messages.join(', ')}\n`;
                            }
                            alert(`Validation Errors:\n${errorMessages}`);
                        }
                    }
                })

            });

        function fetchLiveQuestions() {
            fetch("{{ route('questions.live') }}")
                .then((response) => response.json())
                .then((data) => {
                    const preservedQuestionId = currentQuestionId;
                    const preservedPage = questionPages[preservedQuestionId] || 1;

                    data.forEach((question) => {
                        const existingButton = document.querySelector(
                            `button.question-tab-button[data-question-id="${question.question_id}"]`
                        );
                        const existingQuestionBox = document.getElementById(`question-${question.question_id}`);

                        if (!existingButton && !existingQuestionBox) {
                            const button = document.createElement('button');
                            button.className = 'question-tab-button';
                            button.innerText = question.question_name;
                            button.setAttribute('data-question-id', question.question_id);
                            button.setAttribute('data-competitor-id', question.competitor_id);
                            questionTabButtons.appendChild(button);

                            const questionBox = document.createElement('div');
                            questionBox.className = 'question-box';
                            questionBox.id = `question-${question.question_id}`;
                            questionBox.setAttribute('data-question-id', question.question_id);
                            questionBox.setAttribute('data-competitor-id', question.competitor_id);

                            let ayatDetails = '';
                            if (question.ayat_details) {
                                question.ayat_details.forEach((ayat, index) => {
                                    ayatDetails += `<span class="ayat-text">${ayat.ayah_ar} <strong>${ayat.surah_no}:${ayat.ayah_no_surah}</strong>${index < question.ayat_details.length - 1 ? ',' : ''}</span>`;
                                });
                            }

                            questionBox.innerHTML = `
                                <h5>Question: ${question.question_name}</h5>
                                <div class="ayat-container">${ayatDetails}</div>
                                <div class="pagination-controls" style="display: none;">
                                    <button type="button" class="prev-page">Previous</button>
                                    <span class="pagination-info">Page <span class="current-page">1</span> of <span class="total-pages">1</span></span>
                                    <button type="button" class="next-page">Next</button>
                                </div>
                            `;
                            questionContainer.appendChild(questionBox);

                            setupPagination(questionBox);
                        }
                    });

                    if (preservedQuestionId) {
                        displayQuestion(preservedQuestionId, preservedPage);
                    }
                });
        }

        fetchLiveQuestions();
        setInterval(fetchLiveQuestions, 3000);
    });
     </script>
</body>

</html>
