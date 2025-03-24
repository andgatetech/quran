<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competition Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
         body {
position:relative;
            background-color: #f8f9fa;

        }

        .main-title {
            background-color: var(--secondary-color);
            color: var(--primary-color);
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
        }


        .details-container {
            background-color: var(--primary-color);
            border: 2px solid var(--secondary-color);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            /* Set a specific width to make it narrower */
            margin-left: auto;
            margin-right: auto;
        }

        .details-container h3 {
            color: var(--secondary-color);
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .details {
            font-size: 16px;
            line-height: 1.8;
            display: grid;
            grid-template-columns: 1fr 1fr;
            /* Make columns equally spaced */
            gap: 10px;

        }

        .details p {
            margin: 0;
        }

        .details p:last-child {
            text-align: right;
            /* Aligns the content of the last child (strong tag) to the right */
        }

        .details p strong {
            display: block;
            text-align: right;
            /* Aligns the strong content to the right */
            color: var(--secondary-color);
        }

        .action-buttons {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .action-button {
            border: none;
            border-radius: 15px;
            padding: 10px 20px;
            font-size: 16px;
            color: var(--primary-color);
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .announce-button {
            background-color: var(--secondary-color);
        }

        .recheck-button {
            background-color: #ff9800;
        }


    </style>
</head>

<body>

    <div class="container">
        <!-- Main Title -->
        <div class="main-title">
            <h2>{{ $competition->main_name }}</h2>
            <h3>{{ $competition->sub_name }}</h3>
        </div>

        <!-- Competition Details -->
        <div class="details-container">
            <h3>Competition Details</h3>

            <div id="competitors-list">
                <p>Loading winners...</p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            const fetchWinners = () => {
                $.ajax({
                    url: '{{ route('winning.fetch-winners') }}', // Fetch data from this route
                    method: 'GET',
                    success: function (competitors) {
                        const container = $('#competitors-list');
                        container.empty(); // Clear existing content

                        if (!competitors || competitors.length === 0) {
                            container.html('<p>No winners announced yet.</p>');
                            return;
                        }

                        competitors.forEach(competitor => {
                            const rankSuffix = competitor.position == 1
                                ? 'st'
                                : competitor.position == 2
                                ? 'nd'
                                : competitor.position == 3
                                ? 'rd'
                                : 'th';

                            const resultsHtml = competitor.results
                                ?.map(result => `
                                    <p>Point Category Name:</p>
                                    <p><strong>${result.point_category_name || 'N/A'}: ${result.total_points}/${result.gained_points}</strong></p>
                                `)
                                .join('') || '';

                            const totalPoints = competitor.results
                                ? competitor.results.reduce((sum, r) => sum + r.total_points, 0)
                                : 0;

                            const gainedPoints = competitor.results
                                ? competitor.results.reduce((sum, r) => sum + r.gained_points, 0)
                                : 0;

                            const competitorHtml = `
                                <div class="details">
                                    <p>Place:</p>
                                    <p><strong>${competitor.position ? competitor.position + rankSuffix : 'N/A'}</strong></p>

                                   <p>Name:</p>
                                    <p><strong>${competitor.full_name || 'N/A'}</strong></p>

                                    <p>ID Card Number:</p>
                                    <p><strong>${competitor.id_card_number || 'N/A'}</strong></p>

                                    <p>Competition Name:</p>
                                    <p><strong>${competitor.competition_name}</strong></p>

                                    <p>Age Category:</p>
                                    <p><strong>${competitor.age_category_name}</strong></p>

                                    <p>Reading Side:</p>
                                    <p><strong>${competitor.read_category_name}</strong></p>

                                    <p>Side Category:</p>

                                    <p><strong>${competitor.side_category_name }</strong></p>

                                    ${resultsHtml}

                                    <p>Total # of Points:</p>
                                    <p><strong>${totalPoints}/${gainedPoints}</strong></p>
                                </div>

                                <div class="action-buttons">
                                    <form action="{{ route('competitor.announce', '') }}/${competitor.id}" method="POST" style="display:inline-block; cursor:pointer">
                                        @csrf
                                        <button class="action-button announce-button" type="submit">Announce</button>
                                    </form>

                                    <form action="{{ route('competitor.recheck', '') }}/${competitor.id}" method="POST" style="display:inline-block; cursor:pointer">
                                        @csrf
                                        <button class="action-button recheck-button" type="submit">ReCheck</button>
                                    </form>
                                </div>
                            `;

                            container.append(competitorHtml);

                            // Log rank and other data for debugging
                            console.log(`Rank: ${competitor.position}, Name: ${competitor.full_name}`);
                            console.log(`Age Category: ${competitor.ageCategory?.name}`);
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching winners:', error);
                        $('#competitors-list').html('<p>Error loading winners. Please try again later.</p>');
                    }
                });
            };

            // Fetch winners initially and every 5 seconds
            fetchWinners();
            setInterval(fetchWinners, 5000); // 5 seconds interval
        });
    </script>


@include('includes.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
