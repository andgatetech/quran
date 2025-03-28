@extends('layouts.app')
@section('content')
<header class="header">
    <a class="back-btn" href="{{ route('client.menu.quran') }}"><i class="fas fa-home"></i></a>
    <h1>View Questions</h1>
  </header>

  <div class="container1">
<div class="tabs">
<button class="tab-btn "  onclick="window.location.href='{{ route('questions.create') }}'">Create Question</button>
<button class="tab-btn " onclick="window.location.href='{{ route('questions.list') }}'">Question List</button>
</div>
  </div>
  <style>
    :root {
        --primary-color: #FFFFFF; /* White */
        --secondary-color: #016da8 !important; /* Green */
        --text-color: #333333; /* Dark gray */
        --background-color: #F9F9F9; /* Light gray background */
        --card-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        --border-radius: 10px;
        --spacing: 15px;
    }


    .question-details-card {
        background-color: var(--primary-color);
        border: 2px solid var(--secondary-color);
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        padding: var(--spacing);
        margin-bottom: 20px;
    }

    .question-details-card h3 {
        text-align: center;
        font-size: 1.8rem;
        margin-bottom: var(--spacing);
        color: var(--secondary-color);
        border-bottom: 2px solid var(--secondary-color);
        padding-bottom: 10px;
    }

    .question-details-card ul {
        list-style-type: none;
        padding: 0;
    }

    .question-details-card li {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid var(--background-color);
    }

    .question-details-card li:last-child {
        border-bottom: none;
    }

    .question-details-card li strong {
        font-weight: bold;
        color: var(--secondary-color);
    }

    @media (max-width: 600px) {
        .container {
            padding: 10px;
        }

        .question-details-card h3 {
            font-size: 1.5rem;
        }

        .question-details-card li {
            flex-direction: column;
            padding: 5px 0;
        }

        .question-details-card li strong {
            display: block;
            margin-bottom: 5px;
        }
    }
</style>

<div class="container">
    <div class="question-details-card">
        <h3>{{ $question->question_name }}</h3>
        <ul>
            <li><strong>Competition Name:</strong> <span>{{ $question->competition_name }}</span></li>
            <li><strong>Age Category:</strong>
                <span>{{ $question->ageCategory ? $question->ageCategory->name : 'N/A' }}</span>
            </li>
            <li><strong>Side Category:</strong>
                <span>{{ $question->sideCategory ? $question->sideCategory->name : 'N/A' }}</span>
            </li>
            <li><strong>Read Category:</strong>
                <span>{{ $question->readCategory ? $question->readCategory->name : 'N/A' }}</span>
            </li>
            <li><strong>Book Number:</strong> <span>{{ $question->book_number }}</span></li>
            <li><strong>From Ayat Number:</strong> <span>{{ $question->from_ayat_number }}</span></li>
            <li><strong>To Ayat Number:</strong> <span>{{ $question->to_ayat_number }}</span></li>
            <li><strong>Hardness:</strong> <span>{{ $question->hardness }}%</span></li>
        </ul>
    </div>
</div>


@endsection
