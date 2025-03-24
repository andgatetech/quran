@extends('layouts.app')
@section('content')
<style>
    .container {
        flex-grow: 1;
        /* Make the container take up the available space between header and footer */
        width: 100%;
        max-width: 100%;
        /* Full width for container */
        text-align: center;
        margin: 0 auto;
        /* Center the container horizontally */
    }

    .list-container {
        display: inline-block;
        width: 100%;
        max-width: 100%;
        /* Full width for container */
        text-align: center;
        margin: 0 auto;
        min-height: 20rem !important;
        margin-top: 1rem !important;
        max-height: 60rem !important;
        box-shadow: none  !important;

    }

    .question-card {
        border: 1px solid var(--secondary-color)
    }

    .list-container,
    .question-details-card {
        margin-bottom: 6rem !important;
    }

    .question-details {
        display: none;
        margin-top: 1rem;
        padding:0 10px;
        /* background-color: #f7f8fa; */
        border-radius: 10px;
    }

    .question-card.active .question-details {
        display: block;
    }



    .question-details p {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 5px 0;
        font-size: 14px;
        line-height: 1.5;
        max-width: 100% !important;
        position: relative !important;
    }

    .question-details p strong {
        text-align: left !important;
        color: #000;
        font-weight: bold;

    }

    .question-details p  {
        text-align: right !important; /* Dynamic part aligned to the right */
        color: var(--secondary-color) !important;
        position: absolute;
        right: 0;
    }
</style>
<style>
    .question-card.active .question-header i {
    transform: rotate(180deg);  /* Rotates the arrow icon */
    transition: transform 0.3s ease-in-out;
}
.question-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.question-header p {
  font-size: 14px;
  display: flex;
  justify-content: space-between;
  padding: 0 !important;
  margin: 0 !important;
  width: 100%; /* Ensures the text spans the width */
}

.question-header span {
  color: var(--secondary-color);
  font-weight: bold;
  margin-left: auto; /* Pushes span to the right */
}

.question-header i {
  color: #888;
  cursor: pointer;
  margin-left: 8px; /* Add some spacing between the text and the icon */
}

p{}

/* Container for the form to ensure it stays in one row */
.filter-form {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 20px;
}

/* Each filter group should have the label on top and dropdown below */
.filter-group {
    text-align: center;
    width: 30%;
}

.filter-label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

.filter-dropdown {
    width: 100%;
    padding: 8px;
    border: 1px solid #016da8;
    border-radius: 4px;
    background-color: #f4f8fb;
    color: #016da8;
    font-size: 14px;
}

.filter-dropdown option {
    color: #333;
}

.filter-dropdown:focus {
    border-color: #016da8;
    outline: none;
}

button[type="submit"] {
    background-color: #016da8;
    color: white;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 4px;
    font-size: 16px;
}

button[type="submit"]:hover {
    background-color: #015b7a;
}



</style>
    <header class="header">
        <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a>
        <h1> Questions List</h1>
    </header>

    <div class="container1">
        <div class="tabs">

            <button class="tab-btn " onclick="window.location.href='{{ route('questions.create') }}'">Create Question</button>
            <button class="tab-btn active" onclick="window.location.href='{{ route('questions.list') }}'">Question
                List</button>
        </div>
    </div>

    <div class="container">
    <!-- Filter Form -->
    <form method="GET" action="{{ route('questions.list') }}" class="filter-form">
        <div class="filter-group mt-2">
            <label for="sideCategory" class="filter-label">Side Category:</label>
            <select name="sideCategory" id="sideCategory" class="filter-dropdown">
                <option value="">All Side Categories</option>
                @foreach($sideCategories as $sideCategory)
                    <option value="{{ $sideCategory->id }}" {{ request('sideCategory') == $sideCategory->id ? 'selected' : '' }}>
                        {{ $sideCategory->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter-group mt-2">
            <label for="readCategory" class="filter-label">Read Category:</label>
            <select name="readCategory" id="readCategory" class="filter-dropdown">
                <option value="">All Read Categories</option>
                @foreach($readCategories as $readCategory)
                    <option value="{{ $readCategory->id }}" {{ request('readCategory') == $readCategory->id ? 'selected' : '' }}>
                        {{ $readCategory->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter-group mt-2">
            <label for="ageCategory" class="filter-label">Age Category:</label>
            <select name="ageCategory" id="ageCategory" class="filter-dropdown">
                <option value="">All Age Categories</option>
                @foreach($ageCategories as $ageCategory)
                    <option value="{{ $ageCategory->id }}" {{ request('ageCategory') == $ageCategory->id ? 'selected' : '' }}>
                        {{ $ageCategory->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Filter</button>

    </form>

    <!-- List of Questions -->
    <div class="list-container">
        @foreach($questions as $question)
        <div class="question-card" style="background-color: rgb(255, 255, 255)" onclick="this.classList.toggle('active')">
            <div class="question-header">
                <p>Question :<span>{{ $question->question_name }}
                <i class="fas fa-chevron-down"></i></span></p>
            </div>

            <div class="question-details">
                <p><strong>Competition Name:</strong> {{ $question->competition ? $question->competition->main_name : 'N/A' }}</p>
                <p><strong>Age Category:</strong> {{ $question->ageCategory ? $question->ageCategory->name : 'N/A' }}</p>
                <p><strong>Side Category:</strong> {{ $question->sideCategory ? $question->sideCategory->name : 'N/A' }}</p>
                <p><strong>Read Category:</strong> {{ $question->readCategory ? $question->readCategory->name : 'N/A' }}</p>

                <p><strong>Book #:</strong> {{ $question->book_number }}</p>
                <p><strong>From Ayah#:</strong> {{ $question->from_ayat_number }}</p>
                <p><strong>To Ayah#:</strong> {{ $question->to_ayat_number }}</p>
                <div class="question-actions">
                    <form action="{{ route('questions.delete', $question->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn-action btn-delete" type="submit">Delete</button>
                    </form>
                    <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-primary btn-sm mr-2">Edit</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
