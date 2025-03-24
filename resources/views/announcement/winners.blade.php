<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competition Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            position: relative;
            background-color: #f8f9fa;

            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 60vw;
            width: 100%;
        }



        .content-area {
            border: none;
            border-radius: 15px;
            width: 100% !important;
            max-width: 100% !important;
            background: white;
            margin: 20px 0;
            padding: 30px;
            overflow-x: auto;
        }


        .main-block {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            background-color: var(--primary-color);
            border: 2px solid #d4a026;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
            min-width: 300px;
            max-width: 300px;

        }

        .main-block .category {
            background-color: #d4a026;
            color: var(--primary-color);
            font-weight: bold;
            font-size: 18px;
            padding: 15px 10px;
            border-radius: 1rem;

            width: 100%;
        }

        .main-block .name {
            margin: 20px 0;
            font-weight: bold;
            font-size: 16px;
            color: black;
        }

        .main-block .footer {
            background-color: #d4a026;
            color: var(--primary-color);
            font-weight: bold;
            font-size: 16px;
            border-radius: 1rem;
            padding: 10px 0;
            width: 100%;
        }


        .sponsor-title {
            text-align: center;
            background-color: var(--secondary-color) !important;
            color: var(--primary-color);
            border-radius: 15px;
            width: 100%;
            max-width: 100%;
            padding: 10px;
            margin-bottom: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 16px;
            font-weight: bold;
        }

        .sponsor-list {
            text-align: center;
            background-color: transparent;
            color: var(--secondary-color) !important;
            border-radius: 15px;
            width: 90%;
            max-width: 1200px;
            padding: 10px;
            /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
            font-size: 14px;
        }



        @media (max-width: 768px) {

            .content-area,
            .sponsor-title,
            .sponsor-list {
                width: 100% !important;
            }

            .main-block {
                font-size: 16px;
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
            border: 2px solid var(--secondary-color) !important;
            color: var(--secondary-color) !important;
        }

        .custom-button-white:hover {
            background-color: var(--secondary-color) !important;
            color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Button with green background */
        .custom-button-green {
            background-color: var(--secondary-color) !important;
            color: #fff;
            border: none;
        }

        .custom-button-green:hover {
            background-color: var(--secondary-color) !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }



        .main-block.gold {
            border-color: #d4a026;
        }

        .main-block.gold .category,
        .main-block.gold .footer {
            background-color: #d4a026;
            color: #fff;
        }

        .main-block.silver {
            border-color: #b0b0b0;
        }

        .main-block.silver .category,
        .main-block.silver .footer {
            background-color: #b0b0b0;
            color: #000;
        }

        .main-block.black {
            border-color: #000;
        }

        .main-block.black .category,
        .main-block.black .footer {
            background-color: #000;
            color: #fff;
        }

        .main-block.blue {
            border-color: #007bff;
        }

        .main-block.blue .category,
        .main-block.blue .footer {
            background-color: #007bff;
            color: #fff;
        }

        .sponsored-header {
            background-color: var(--secondary-color);
            color: var(--primary-color) !important;
            text-align: center;
            padding: .5rem !important;
            font-size: .9rem !important;
            ;
            border-radius: 1rem;
            margin-bottom: 5rem;

            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;

            font-size: 1.5rem;
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;

            width: 100%;
        }

        .sponsored-header h2,
        .sponsored-header h3 {
            margin: 0;
            padding: 0;
            height: fit-content;
        }





        .sponsor-list-wrapper {
            overflow: hidden;
            width: 100%;
            /* Adjust width as per your requirement */
            background-color: var(--primary-color);
            /* Optional: Background color */
            border: 1px solid #ddd;
            /* Optional: Border */
            padding: 10px 0;
        }

        .sponsor-list {
            display: inline-flex;
            white-space: nowrap;
            animation: scroll 16s linear infinite;
            /* Adjust timing as needed */
        }

        .sponsor-item {
            margin-right: 20px;
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        @keyframes scroll {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .container3 {
            width: 80%;
        }

        .row-wrapper {
            display: flex;
            gap: 15px;
            flex-wrap: nowrap;
            overflow: hidden;
            /* Hide overflowing content */
            white-space: nowrap;
            /* Prevent cards from wrapping to the next line */
            position: relative;
        }

        .row-wrapper .main-block {
            display: inline-block;
            /* Ensure cards are inline */
            white-space: normal;
            /* Allow text to wrap within the cards */
            flex-shrink: 0;
            /* Prevent cards from shrinking */
            width: 250px;
            /* Adjust card width as needed */
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            background-color: #f9f9f9;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }


        /* Sliding animation */
        @keyframes slide {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-100%);
            }
        }

        .slider {
            display: flex;
            animation: slide 20s linear infinite;
            /* Adjust duration as needed */
        }

        .slider .main-block {
            margin-right: 15px;
            /* Spacing between cards */
        }
    </style>
</head>

<body>


    <div class="container">
        <div class="sponsored-header">
            <h3>Competition Main Name </h3><br>
            <h4> Competition Sub Name</h4>
        </div>







        <div class="content-area" style="width: 100% !important;">
            <div class="row-wrapper" id="winners-container">
                <div class="slider" id="slider">
                    <p>Loading winners...</p>
                </div>
            </div>
        </div>




        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script>
            $(document).ready(function() {
                function fetchWinners() {
                    const sideCategoryId = $('#sideCategoryFilter').val();
                    const readCategoryId = $('#readCategoryFilter').val();
                    const ageCategoryId = $('#ageCategoryFilter').val();

                    $.ajax({
                        url: '{{ route('ajax.winners') }}',
                        method: 'GET',
                        data: {
                            side_category_id: sideCategoryId,
                            read_category_id: readCategoryId,
                            age_category_id: ageCategoryId
                        },
                        success: function(winners) {
                            const slider = $('#slider');
                            slider.empty(); // Clear the existing slider content

                            if (winners.length === 0) {
                                slider.html('<p>No winners announced yet.</p>');
                                return;
                            }

                            // Render each winner dynamically
                            winners.forEach(winner => {
                                const rankClass = winner.rank == 1 ? 'gold' :
                                    (winner.rank == 2 ? 'silver' :
                                        (winner.rank == 3 ? 'black' : 'blue'));

                                const rankText = winner.rank == 1 ? 'st' :
                                    (winner.rank == 2 ? 'nd' :
                                        (winner.rank == 3 ? 'rd' : 'th'));

                                const winnerHtml = `
                            <div class="main-block ${rankClass}">
                                <div class="category">
                                    <strong>${winner.rank}${rankText} Place in:</strong>
                                    <br>${winner.competition_name}
                                </div>
                                <div class="name">
                                    <h3>${winner.competitor_name}</h3>
                                    <p>ID: ${winner.id_card_number || 'N/A'}</p>
                                </div>
                                <div class="categories">
                                    <p><strong>Age Category:</strong> ${winner.age_category_name}</p>
                                    <p><strong>Read Category:</strong> ${winner.read_category_name}</p>
                                    <p><strong>Side Category:</strong> ${winner.side_category_name}</p>
                                </div>
                                <div class="footer">Congratulations!</div>
                            </div>
                        `;
                                slider.append(winnerHtml);
                            });

                            // Duplicate content to create infinite scrolling effect
                            slider.append(slider.html());
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching winners:', error);
                            $('#slider').html('<p>Error loading winners. Please try again later.</p>');
                        }
                    });
                }

                // Fetch winners on page load
                fetchWinners();

                // Fetch winners when filters change
                $('#sideCategoryFilter, #readCategoryFilter, #ageCategoryFilter').on('change', function() {
                    fetchWinners();
                });

                // Periodically refresh winners
                setInterval(fetchWinners, 5000);
            });
        </script>


        <style>
            .category,
            .name,
            .categories {
                margin-bottom: 10px;
            }

            .categories p {
                margin: 5px 0;
            }
        </style>













        {{-- <script>
        $(document).ready(function() {
            function fetchWinners() {
                $.ajax({
                    url: '{{ route('ajax.winners') }}', // AJAX endpoint
                    method: 'GET',
                    success: function(winners) {
                        const container = $('#winners-container');
                        container.empty(); // Clear the existing content

                        if (winners.length === 0) {
                            container.html('<p>No winners announced yet.</p>');
                            return;
                        }

                        // Update main and sub titles
                        $('#main-title').text(winners[0]?.main_name || 'Competition Name');
                        $('#sub-title').text(winners[0]?.sub_name || 'Sub Name');

                        // Render each winner dynamically
                        winners.forEach(winner => {
                            const rankClass = winner.rank == 1 ? 'gold' :
                                (winner.rank == 2 ? 'silver' :
                                    (winner.rank == 3 ? 'black' : 'blue'));

                            const rankText = winner.rank == 1 ? 'st' :
                                (winner.rank == 2 ? 'nd' :
                                    (winner.rank == 3 ? 'rd' : 'th'));

                            const winnerHtml = `
                                <div class="main-block ${rankClass}">
                                    <div class="category">
                                        ${winner.rank}${rankText} Place in
                                        <br>${winner.main_name}
                                        <br>${winner.sub_name}
                                    </div>
                                    <div class="name">
                                        ${winner.full_name}
                                        <br>(${winner.id_card_number})
                                    </div>
                                    <div class="footer">Congratulations</div>
                                </div>

                            `;
                            container.append(winnerHtml);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching winners:', error);
                        $('#winners-container').html(
                            '<p>Error loading winners. Please try again later.</p>');
                    }
                });
            }

            // Fetch winners every 5 seconds
            fetchWinners();
            setInterval(fetchWinners, 5000);
        });
    </script> --}}








        <div class="sponsor-title">
            Sponsored By
        </div>


        <div class="sponsor-list-wrapper">
            <div class="sponsor-list" id="sponsor-list">
                @foreach ($sponsors as $sponsor)
                    <span class="sponsor-item">{{ $sponsor->name }} -- </span>
                @endforeach
            </div>
        </div>


        <div class="container mt-5" style="box-shadow: none;border:none;">
            <div class="d-flex gap-3 justify-content-end">
                <!-- Button 1 -->
                <a href="{{ route('announcement.index') }}" class="custom-button custom-button-white">S1</a>

                <!-- Button 2 -->
                <a href="{{ route('announcement.winners') }}" class="custom-button custom-button-green ">S2</a>
            </div>
        </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
