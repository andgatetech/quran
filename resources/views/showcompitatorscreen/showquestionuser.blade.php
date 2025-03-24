<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competition Questions</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=notifications_active" />


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
    <style>
        body {
            position: relative;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
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
        .container {
            max-width: 800px;
            margin: 50px auto;
            text-align: center;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            margin-bottom: 20px;
        }

        .header h2 {
            color: #44a089;
            margin-bottom: 5px;
            font-size: 28px;
        }

        .header h3 {
            color: #666;
            font-weight: normal;
            font-size: 18px;
        }


        .question-title {
            color: #44a089;
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .detail {
            margin-top: 10px;
            font-size: 16px;
            color: #333;
        }

        .detail span {
            color: #44a089;
            font-weight: bold;
        }

        .no-questions {
            background: #fff5f5;
            border: 1px solid #f5c2c2;
            border-radius: 10px;
            padding: 30px;
            color: #e74c3c;
            font-size: 18px;
        }
    </style>
    <style>
        .detail-container {
            text-align: right;
            /* Align text to the right for RTL languages */
            direction: rtl;
            /* Ensure proper RTL direction */
            font-family: 'Amiri', serif;
            /* Arabic calligraphy-friendly font */
            font-size: 22px;
            /* Adjust font size */
            line-height: 1.8;
            /* Line height for readability */
            margin: 15px 0;
            /* Add spacing between elements */
            background:var(--primary-color); ;
            /* Subtle background for elegance */
            /* padding: 15px; */
            border-radius: 10px;
            /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
            /* Slight shadow for depth */
            color: #333;
            /* Text color */
        }

        .detail-container .text-label {
            display: inline-block;
            font-weight: bold;
            font-size: 18px;
            margin-left: 5px;
            /* Add spacing between label and text */
            color: var(--secondary-color);
            /* Highlighted color for labels */

        }

        .detail-container .text-content {
            font-family: 'Amiri', serif;
            /* Consistent Arabic font */
            font-weight: normal;
            color: #000;

            /* Text color */

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

</head>

<body>



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


        <!-- Question Display Container -->
        <div id="question-content">
            @if ($questions->isEmpty())
                <div class="no-questions">No more active questions available.</div>
            @else
                @foreach ($questions as $question)

                    <div class="question-box">
                        <div class="detail-container">
                            <span class="text-content">{{ $question->text }}</span>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>


    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Regular expression to match Arabic numerals (٠ to ٩)
            const arabicNumeralsRegex = /[٠-٩]+/g;

            // Select all elements with the .text-content class
            const textElements = document.querySelectorAll('.text-content');

            textElements.forEach(element => {
                // Replace Arabic numbers in the text with styled spans
                element.innerHTML = element.innerHTML.replace(
                    arabicNumeralsRegex,
                    match => `<span class="ayat-number">${match}</span>`
                );
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function fetchLiveData() {
                fetch("{{ route('questions.live.data') }}")
                    .then(response => response.json())
                    .then(data => {
                        const container = document.getElementById('question-content');
                        container.innerText = '';
                        if (data.length === 0) {
                            container.innerHTML =
                                '<div class="no-questions">No more active questions available.</div>';
                        } else {
                            data.forEach(question => {
                                let questionBox = document.createElement('div');
                                questionBox.className = 'question-box';
                                questionBox.innerHTML = ` <div class="detail-container">
                            <span class="text-content">${question.text}</span>
                        </div>
                                `;
                                container.appendChild(questionBox);
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching live data:', error));
            }

            // Initial fetch
            fetchLiveData();

            // Fetch data every 4 seconds
            setInterval(fetchLiveData, 3000);
        });
    </script>
</body>

</html>
