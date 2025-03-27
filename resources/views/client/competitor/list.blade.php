@extends('layouts.app')

@section('content')
<header class="header">
    <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a>
    <h1> Competitor List</h1>
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
    </style>
<button class="tab-btn "  onclick="window.location.href='{{ route('competitors.create') }}'">Create Competitor</button>
<button class="tab-btn active" onclick="window.location.href='{{ route('competitors.index') }}'">Competitor List</button>
</div>


  <style>
     .container {
        /* flex-grow: 1; */
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
        max-height: 60rem !important;
        margin: 0 0 6vw 0;


    }
    .list-item.active .question-header i {
    transform: rotate(180deg);  /* Rotates the arrow icon */
    transition: transform 0.3s ease-in-out;
}
.details strong  {color: black}
.details p  {
        color: var(--secondary-color) !important;
        margin: 0;
    }
    .list-item{padding: .4rem !important;}

</style>

    <div class="container my-5">

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-custom animate__animated animate__fadeInDown" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Message -->
        @if(session('error'))
            <div class="alert alert-danger alert-custom animate__animated animate__fadeInDown" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <!-- Competitor List -->
        <div class="list-container">
            {{-- <div class="list-header">Competitor List</div> --}}
            @forelse($competitors as $competitor)
            <div class="list-item mb-3 p-3 border rounded" onclick="this.classList.toggle('active')">
                <div class="question-header">
                    <span><strong>{{ $competitor->full_name }}</strong> ({{ $competitor->id_card_number }})</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
        
                    <div class="details mt-2" style="display: none; box-shadow:0 !important;">
                    <p><strong>Name in English:</strong> {{ $competitor->full_name }}</p>
                    <p><strong>Name in Dhivehi:</strong> {{ $competitor->full_name_dhivehi }}</p>
                    <p><strong>ID Card Number:</strong> {{ $competitor->id_card_number }}</p>
                    <p><strong>Address:</strong> {{ $competitor->address }}</p>
                    <p><strong>Island / City:</strong> {{ $competitor->island_city }}</p>
                    <p><strong>School:</strong> {{ $competitor->school_name ?? 'N/A' }}</p>
                    <p><strong>Parent:</strong> {{ $competitor->parent_name }}</p>
                    <p><strong>Phone Number:</strong> {{ $competitor->phone_number }}</p>
                    <p><strong>Competition Name:</strong> {{ $competitor->competition->main_name ?? 'N/A' }}</p>
                    <p><strong>Side Category:</strong> {{ $competitor->sideCategory->name ?? 'N/A' }}</p>
                    <p><strong>Read Category:</strong> {{ $competitor->readCategory->name ?? 'N/A' }}</p>
                    <p><strong>Age Category:</strong> {{ $competitor->ageCategory->name ?? 'N/A' }}</p>
                    <p><strong>Number of Questions:</strong> {{ $competitor->number_of_questions }}</p>
                    <div class="button-group-inline mt-3">
                        <a href="{{ route('competitors.edit', $competitor->id) }}" class="btn btn-edit btn-warning">Edit</a>
                        <form action="{{ route('competitors.destroy', $competitor->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete btn-danger" onclick="return confirm('Are you sure you want to delete this competitor?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>No competitors found.</p>
        @endforelse
        </div>
    </div>

    <!-- JavaScript to toggle details -->
    <script>
        document.querySelectorAll('.list-item').forEach(item => {
            item.addEventListener('click', function(e) {
                // Prevent toggling when clicking on buttons
                if (e.target.tagName.toLowerCase() !== 'button' && e.target.tagName.toLowerCase() !== 'a') {
                    this.querySelector('.details').style.display = this.classList.contains('active') ? 'block' : 'none';
                }
            });
        });
    </script>

@endsection
