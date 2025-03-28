<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full Width Layout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <style>



        .main-content {
            flex: 1; /* Allows the main content to grow and fill available space */
            width: 100%;
            padding: 20px;
        }


        .button-group1 {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .button-group1 .btn {
            border-radius: 30px;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s;
            padding: 10px 20px;
        }

        .active-button {
            background-color: var(--secondary-color);
            color: #ffffff;
        }

        .form-container {
            padding: 15px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 10px;
            display: block;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .btn-submit {
            background-color: var(--secondary-color);
            color: #ffffff;
            border-radius: 10px;
            font-size: 18px;
            padding: 10px 20px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .header {
                font-size: 22px;
                /* padding: 15px; */
            }

            .button-group1 {
                flex-direction: column;
                gap: 10px;
            }

            .form-container {
                padding: 10px;
            }

            .form-group label {
                font-size: 14px;
            }

            .form-control {
                font-size: 14px;
                padding: 8px;
            }

            .btn-submit {
                font-size: 16px;
                padding: 8px 16px;
            }
        }

        @media (max-width: 480px) {
            .header {
                font-size: 18px;
                padding: 10px;
            }

            .button-group1 {
                flex-direction: column;
                gap: 8px;
            }

            .form-container {
                padding: 8px;
            }

            .form-group label {
                font-size: 12px;
            }

            .form-control {
                font-size: 12px;
                padding: 6px;
            }

            .btn-submit {
                font-size: 14px;
                padding: 6px 12px;
            }
        }



















    .container1{margin-top: 2rem !important;}



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


    </style>
</head>
<body>





    <header class="header">
        <a class="back-btn" href="{{ route('client.menu.quran') }}"><i class="fas fa-home"></i></a>
        Create Host
    </header>
    <div class="button-group1">
        <a href="{{ route('host.create') }}" class="btn btn-outline-success active-button">Host Competition</a>
        <a href="{{ route('competitions.list') }}" class="btn btn-outline-success ">Competitions</a>
        <a href="{{ route('host.announce') }}" class="btn btn-outline-success">Announce Winners</a>
    </div>

    <div class="container">


            <div class="form-container">
                @if (session('success'))
                    <div class="alert alert-success alert-custom animate__animated animate__fadeInDown" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('host.store') }}" method="POST">
                    @csrf
                    {{-- <label for="host-id">Competition Informations</label> --}}

                    <div class="form-group">
                        <select class="form-control" name="competition_id" id="select-competition">
                            <option value="">Select Competition</option>
                            @foreach ($competitions as $competition)
                                <option value="{{ $competition->id }}">
                                    {{ $competition->main_name }} - {{ $competition->sub_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('competition_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="competition-sub-name"
                            placeholder="Competition Sub Name (Auto Fill)" readonly>
                    </div>

                    <div class="form-group">
                        <label for="host-id">Host Informations</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="host_id" id="host-id" placeholder="Host ID" readonly>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" id="generate-host-id" onclick="generateHostId()">Generate</button>
                            </div>
                        </div>
                        @error('host_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-save btn">On-Air</button>
                </form>
            </div>
        </div>
    {{-- </div> --}}

    @include('includes.footer')


    <script>
        // Function to generate a random host ID
        function generateHostId() {
            const randomId = 'Host_' + Math.random().toString(36).substring(2, 8) + Math.random().toString(36).substring(2, 6);
            document.getElementById('host-id').value = randomId;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const competitionDropdown = document.getElementById('select-competition');
            const competitionSubNameInput = document.getElementById('competition-sub-name');
            const hostIdInput = document.getElementById('host-id');
            const passwordInput = document.getElementById('password');

            competitionDropdown.addEventListener('change', function() {
                // Get the selected competition ID
                const selectedCompetitionId = competitionDropdown.value;

                if (selectedCompetitionId) {
                    // Find the selected competition's details (you could fetch this dynamically if needed)
                    const selectedCompetition =
                    @json($competitions); // Converting PHP data to JavaScript
                    const competition = selectedCompetition.find(comp => comp.id == selectedCompetitionId);

                    // Auto-fill the Competition Sub Name input
                    if (competition) {
                        competitionSubNameInput.value = competition.sub_name;
                    }
                } else {
                    competitionSubNameInput.value = ''; // Clear the input if no competition is selected
                }
            });

            // Auto-generate Host ID on page load
            generateHostId();
        });
    </script>

</body>
</html>
