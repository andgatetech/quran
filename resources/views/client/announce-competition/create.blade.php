<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
$user = User::find(Auth::id());

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announce Competition</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/createcompetition.css">
    <style>
        .btn {
            font-size: .9rem !important;
            border-radius: .3rem !important;
            padding: .4rem 0 !important;
            border: 1px solid var(--secondary-color) !important;
            background-color: var(--secondary-color) !important;
            color: var(--primary-color) !important;
            cursor: pointer !important;
            text-align: center !important;
            margin: 5px !important;
        }


        .competition-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .competition-form input {
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 10px;
            outline: none;
        }

        .competition-form .save-btn {
            background-color: var(--secondary-color);
            ;
            color: var(--primary-color);
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .competition-form .save-btn:hover {
            background-color: var(--secondary-color);
        }
    </style>
</head>

<body>



    <header class="header">
        <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a>
        <h1>Announce Competition</h1>
    </header>

    <div class="container1">
        <div class="tabs">

            <button class="tab-btn active "
                onclick="window.location.href='{{ route('competition.announce') }}'">Announce</button>
            <button class="tab-btn " onclick="window.location.href='{{ route('announce-list.index') }}'">Announce
                List</button>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 offset-md-3">

                <div class="form-container">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                  
                <form class="competition-form" method="POST" action="{{ isset($competition) ? route('announce-list.update', $competition->id) : route('announce-list.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method(isset($competition) ? 'Put' : 'Post')
                    
                    <select name="competition_id" class="form-select" id="competition_id" required>
                        <option value="">Select Competition</option>
                        @if(isset($competition))
                        <option Selected value="{{ $competition->id }}">{{ $competition->main_name }}</option>
                        @endif
                        @foreach ($competitions as $entry)
                            <option {{ (isset($competition) && $entry->id == $competition->id) ? 'Selected':'' }} value="{{ $entry->id }}">{{ $entry->main_name }}</option>
                        @endforeach
                    </select>

                      <!-- New File Upload Fields -->
                    <div class="row mt-3">
                        <div class="col-md-6 col-sm-12 mb-3">
                            <label style="text-align: left;" for="curriculum">Curriculum</label>
                            <input type="file" class="form-control" id="curriculum" name="curriculum" accept=".pdf,.doc,.docx">
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3">
                            <label style="text-align: left;" for="rules">Rules</label>
                            <input type="file" class="form-control" id="rules" name="rules" accept=".pdf,.doc,.docx">
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-md-6 col-sm-12 mb-3">
                            <label style="text-align: left;">Enable from date</label>
                            <input type="date" value="{{ isset($competition) ? $competition->start_date : '' }}" class="form-control" id="start_date" name="start_date" placeholder="Enable from date" required>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label style="text-align: left;">Disable to date</label>
                            <input type="date" value="{{ isset($competition) ? $competition->end_date : '' }}" class="form-control" id="end_date" name="end_date" placeholder="Disable to date" required>
                        </div>
                    </div>
                
                    <input type="text" id="no_of_days" value="{{ isset($competition) ? $competition->no_of_days : '' }}" name="no_of_days" placeholder="Total number of days" readonly>
                
                  
                
                    @if(!isset($competition))
                        <button type="button" class="btn btn-info" id="generate_url">Generate Url</button>
                    @endif
                
                    <div class="row mt-2">
                        <div class="col-9">
                            <input type="text" value="{{ isset($competition) ? $competition->url : '' }}" class="form-control" id="url" name="url" placeholder="Url" required readonly>
                            <input type="hidden" id="encryptedidinput" name="encrypted_id">
                        </div>
                        <div class="col-2">
                            <button type="button" class="tab-btn" id="copy_url">Copy</button>
                        </div>
                    </div>
                
                    <button type="submit" class="btn btn-save">Save</button>
                </form>


                </div>

            </div>
        </div>
        <!-- Form Section -->
    </div>


    @include('includes.footer')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    const noOfDaysInput = document.getElementById('no_of_days');
    const generateUrlButton = document.getElementById('generate_url');
    const copyUrlButton = document.getElementById('copy_url');
    const competitionIdSelect = document.getElementById('competition_id');
    const urlInput = document.getElementById('url');
    const encryptedidinput = document.getElementById('encryptedidinput');
    // Display error messages
    function showError(message) {
        alert(message); // Use a better UI for displaying errors if needed
    }

    // Function to calculate and set the number of days
    function calculateDays() {
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);

        if (!startDate || !endDate) {
            noOfDaysInput.value = '';
            return;
        }

        if (endDate < startDate) {
            showError('End date must be after the start date.');
            endDateInput.value = ''; // Clear the invalid end date
            noOfDaysInput.value = ''; // Reset the number of days
            return;
        }

        const timeDifference = endDate - startDate;
        const days = Math.ceil(timeDifference / (1000 * 60 * 60 * 24));
        noOfDaysInput.value = days;
    }

    // Function to encrypt ID into a 6-digit numeric string
    function encryptId(id) {
        const hash = Array.from(id.toString()).reduce((acc, char) => acc + char.charCodeAt(0), 0);
        return (hash % 1000000).toString().padStart(6, '0'); // Ensure it's exactly 6 digits
    }

    // Automatically calculate days on date change with validation
    startDateInput.addEventListener('change', calculateDays);
    endDateInput.addEventListener('change', calculateDays);

    // Generate URL when the "Generate Url" button is clicked
    generateUrlButton.addEventListener('click', function (e) {
        e.preventDefault();

        const competitionId = competitionIdSelect.value;
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);

        if (!competitionId) {
            showError('Please select a competition.');
            return;
        }

        if (!startDate || !endDate) {
            showError('Please enter valid start and end dates.');
            return;
        }

        if (endDate < startDate) {
            showError('End date must be after the start date.');
            return;
        }

        // Encrypt the competition ID
        const encryptedId = encryptId(competitionId);
        encryptedidinput.value = encryptedId;
        // Use the site's base URL dynamically
        const baseUrl = `${window.location.origin}`;
        const generatedUrl = `${baseUrl}/compt/${encryptedId}`;
        urlInput.value = generatedUrl;
    });

    // Copy URL to clipboard when the "Copy" button is clicked
    copyUrlButton.addEventListener('click', function (e) {
        e.preventDefault();

        if (!urlInput.value) {
            showError('Please generate a URL first.');
            return;
        }

        urlInput.select();
        urlInput.setSelectionRange(0, 99999);

        try {
            document.execCommand('copy');
            alert('URL copied to clipboard!');
        } catch (err) {
            showError('Failed to copy URL.');
        }
    });
});

    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    const noOfDaysInput = document.getElementById('no_of_days');
    const generateUrlButton = document.getElementById('generate_url');
    const copyUrlButton = document.getElementById('copy_url');
    const competitionIdSelect = document.getElementById('competition_id');
    const urlInput = document.getElementById('url');
    const encryptedidinput = document.getElementById('encryptedidinput');


    // Function to calculate and set the number of days
    function calculateDays() {
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);

        if (startDate && endDate && endDate >= startDate) {
            const timeDifference = endDate - startDate;
            const days = Math.ceil(timeDifference / (1000 * 60 * 60 * 24));
            noOfDaysInput.value = days;
        } else {
            noOfDaysInput.value = '';
        }
    }

    // Function to encrypt ID into a 10-digit string
    function encryptId(id) {
        const hash = Array.from(id.toString()).reduce((acc, char) => acc + char.charCodeAt(0), 0);
        return (hash % 1000000).toString().padStart(6, '0'); // Ensure it's exactly 6 digits
    }

    // Automatically calculate days on date change
    startDateInput.addEventListener('change', calculateDays);
    endDateInput.addEventListener('change', calculateDays);

    // Generate URL when the "Generate Url" button is clicked
    generateUrlButton.addEventListener('click', function () {
        const competitionId = competitionIdSelect.value;

        if (!competitionId) {
            alert('Please select a competition.');
            return;
        }

        // Encrypt the competition ID
        const encryptedId = encryptId(competitionId);
        encryptedidinput.value = encryptedId;

        // Use the site's base URL dynamically
        const baseUrl = `${window.location.origin}`;
        const generatedUrl = `${baseUrl}/competitions/${encryptedId}`;
        urlInput.value = generatedUrl;
    });

    // Copy URL to clipboard when the "Copy" button is clicked
    copyUrlButton.addEventListener('click', function () {
        if (!urlInput.value) {
            alert('Please generate a URL first.');
            return;
        }

        urlInput.select();
        urlInput.setSelectionRange(0, 99999);

        try {
            document.execCommand('copy');
            alert('URL copied to clipboard!');
        } catch (err) {
            alert('Failed to copy URL.');
        }
    });
});

    </script> --}}
</body>

</html>
