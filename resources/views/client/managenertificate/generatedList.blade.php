@extends('layouts.app')

@section('content')
<header class="header">
    <a class="back-btn" href="{{ route('managenertificate.create') }}"><i class="fas fa-home"></i></a>
    <h1>Generate List</h1>
</header>

<div class="tabs">
    <style>
        .tab-btn {
            float: left;
            border-radius: 30px;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s;
            width: 45% !important;
            padding: .3rem 0;
            margin: .5rem .2rem;
        }
        .nav-buttons {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
            padding: 1rem;
        }

        @media (min-width: 768px) {
            .nav-buttons {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        .nav-btn {
            padding: 0.75rem;
            border: 2px solid #016DA8;
            border-radius: 0.5rem;
            background: none;
            color: #016DA8;
            font-weight: 500;
            transition: all 0.2s;
        }

        .nav-btn.active {
            background-color: #016DA8;
            color: white;
        }
    </style>
    <div class="nav-buttons">
        <button class="nav-btn" onclick="window.location.href='{{ route('managenertificate.create') }}'">Certificate Settings</button>
        <button class="nav-btn" onclick="window.location.href='{{ route('managenertificate.index') }}'">Settings List</button>
        <button class="nav-btn" onclick="window.location.href='{{ route('managenertificate.generate.view') }}'">Generate</button>
        <button class="nav-btn active" onclick="window.location.href='{{ route('managenertificate.generated.list') }}'">Generated List</button>
    </div>
</div>


<style>
    .container {
        width: 100%;
        max-width: 100%;
        text-align: center;
        margin: 0 auto;
    }
    .list-container {
        display: inline-block;
        width: 100%;
        max-width: 100%;
        text-align: center;
        margin: 0 auto;
        min-height: 20rem !important;
        max-height: 60rem !important;
        margin: 0 0 6vw 0;
    }
    .list-item.active .question-header i {
        transform: rotate(180deg);
        transition: transform 0.3s ease-in-out;
    }
    .details strong { color: black; }
    .details p { color: var(--secondary-color) !important; margin: 0; }
    .list-item { padding: .4rem !important; }
    .view-btn {
        background-color: #016DA8;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
    }
    .details {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-in-out;
    }
    
    .list-item.active .details {
        max-height: 500px;
    }
</style>

<div class="container my-5">
    @if(session('success'))
        <div class="alert alert-success alert-custom animate__animated animate__fadeInDown" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-custom animate__animated animate__fadeInDown" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" style="margin: 1rem; padding: 1rem; border-radius: 5px; background-color: #ffebee; border: 1px solid #ffcdd2;">
            <ul style="margin: 0; padding-left: 1.5rem;">
                @foreach ($errors->all() as $error)
                    <li style="color: #c62828; font-size: 14px;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <style>
        .generate_certificate_search{
            width: 300px;
            display: inline-block;
        }
    </style>
    <!-- Competition Filter Dropdown -->
    <form action="{{ route('managenertificate.generated.list') }}" method="get" style="margin-top: 1rem;">
                            @csrf
        <!-- Competition Filter -->
        <div class="generate_certificate_search">
            <label for="competition_filter_" style="font-weight: bold; margin-right: 10px;">Competition:</label>
            <select name="competition_filter" id="competition_filter_" class="form-control" style="width: 300px; display: inline-block;">
                <option value="">All Competitions</option>
                @foreach($competitions as $competition)
                    <option value="{{ $competition->id }}">{{ $competition->main_name }}</option>
                @endforeach
            </select>
        </div>
    
        <!-- Apply Participation Option Dropdown -->
        <div class="generate_certificate_search">
            <label for="certificate_settings" style="font-weight: bold; margin-right: 10px;">Participant Option:</label>
            <select name="participation_option_filter" id="certificate_settings" class="form-control" style="width: 300px; display: inline-block;">
                <option value="">Select Participant Option</option>
                <option value="1">Public</option>
                <option value="2">My Garden</option>
            </select>
        </div>
        <!-- Age Category Dropdown -->
        <div class="generate_certificate_search">
            <label for="age_category" style="font-weight: bold; margin-right: 10px;">Age Category:</label>
            <select name="age_category_filter" id="age_category" class="form-control" style="width: 300px; display: inline-block;">
                <option value="">Select Age Category</option>
                @foreach($ageCategories as $ageCategory)
                    <option value="{{ $ageCategory->id }}">
                        {{ $ageCategory->name ?? 'Untitled Settings' }}
                    </option>
                @endforeach
            </select>
        </div>
        <!-- Side Category Dropdown -->
        <div class="generate_certificate_search">
            <label for="side_category" style="font-weight: bold; margin-right: 10px;">Side Category:</label>
            <select name="side_category_filter" id="side_category" class="form-control" style="width: 300px; display: inline-block;">
                <option value="">Select Side Category</option>
                @foreach($sideCategories as $sideCategory)
                    <option value="{{ $sideCategory->id }}">
                        {{ $sideCategory->name ?? 'Untitled Settings' }}
                    </option>
                @endforeach
            </select>
        </div>
        <!-- Read Category Dropdown -->
        <div class="generate_certificate_search">
            <label for="read_category" style="font-weight: bold; margin-right: 10px;">Read Category:</label>
            <select name="read_category_filter" id="read_category" class="form-control" style="width: 300px; display: inline-block;">
                <option value="">Select Read Category</option>
                @foreach($readCategories as $readCategory)
                    <option value="{{ $readCategory->id }}">
                        {{ $readCategory->name ?? 'Untitled Settings' }}
                    </option>
                @endforeach
            </select>
        </div>
         <!-- Search Button -->
        <div class="generate_certificate_search" style="width: 100px;">
        <button type="submit" class="btn btn-primary">Search</button>
        </div>
</form>
    </div>

    <div class="list-container" style="margin: 1rem;">
        @forelse($generatedCertificates as $generatedCertificate)
            <div class="list-item mb-3 p-4 border rounded shadow-sm" style="background-color: #fff; cursor: pointer; transition: transform 0.3s ease-in-out;" data-competition-id="{{ $generatedCertificate->id }}">
                <div class="question-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <span><strong>Competition Name :</strong> {{ $generatedCertificate->competition_name ?? 'N/A' }}</span>
                    <i class="fas fa-chevron-down" style="color: #016DA8;"></i>
                </div>
    
                <div class="details mt-2" style="margin-top: 1rem; color: #555; background-color: #f9f9f9; padding: 1rem; border-radius: 5px; max-height: 0; overflow: hidden; transition: max-height 0.3s ease-in-out;">
                    <!-- Competitor Details -->
                    <div style="margin-bottom: 1rem; padding: 1rem; border-bottom: 1px solid #ddd;">
                        <p><strong>Sponsor Name :</strong> {{ $generatedCertificate->sponsor_name }}</p>
                        <p><strong>Tin#/ID Card# :</strong> {{ $generatedCertificate->id_card_number }}</p>
                        <p><strong>Certificate Type :</strong> {{ $generatedCertificate->certificate_type }}</p>
                        <p><strong>Status :</strong> {{ $generatedCertificate->status }}</p>
                        <br>
                        <div>
                            <a href="{{ url('storage/app/private/'.$generatedCertificate->pdf) }}" target="_blank" class="btn btn-primary">View</a>
                            <a href="{{ url('storage/app/private/'.$generatedCertificate->pdf) }}" class="btn btn-info">Save</a>
                            <a href="{{ url('storage/app/private/'.$generatedCertificate->pdf) }}" class="btn btn-success">Share</a>
                            <a href="{{ url('storage/app/private/'.$generatedCertificate->pdf) }}" class="btn btn-danger">Revert</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        @empty
            <p>No Competitors found.</p>
        @endforelse
    </div>
    
</div>

<script>
    // Toggle competitor details
    document.querySelectorAll('.list-item').forEach(item => {
        item.addEventListener('click', function(e) {
            if (e.target.tagName.toLowerCase() === 'select' || e.target.tagName.toLowerCase() === 'textarea' || e.target.tagName.toLowerCase() === 'button') {
                return;
            }

            const details = this.querySelector('.details');
            if (this.classList.contains('active')) {
                details.style.maxHeight = '0';
                this.classList.remove('active');
            } else {
                details.style.maxHeight = '500px';
                this.classList.add('active');
            }
        });
    });

    // Filter competitors by competition
        document.getElementById('competition_filter').addEventListener('change', function() {
            const competitionId = this.value; // Get the selected competition ID
            const competitors = document.querySelectorAll('.list-item');

            competitors.forEach(competitor => {
                const competitorCompetitionId = competitor.getAttribute('data-competition-id'); // Get the competition ID from the data attribute
                if (!competitionId || competitorCompetitionId === competitionId) {
                    competitor.style.display = 'block'; // Show the competitor if the competition matches
                } else {
                    competitor.style.display = 'none'; // Hide the competitor if the competition does not match
                }
            });
        });
</script>

<script>
    document.getElementById('certificate_settings').addEventListener('change', function() {
    const selectedSettingsId = this.value;
    
    // Update all hidden inputs for certificate_settings
    document.querySelectorAll('input[name="certificate_settings"]').forEach(input => {
        input.value = selectedSettingsId;
    });
});
</script>

@endsection