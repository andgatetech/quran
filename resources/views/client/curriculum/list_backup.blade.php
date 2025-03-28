@extends('layouts.app')

@section('content')
<header class="header">
    <a class="back-btn" href="{{ route('client.menu.quran') }}"><i class="fas fa-home"></i></a>
    <h1> Curriculum List</h1>
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
    <button class="tab-btn" onclick="window.location.href='{{ route('curriculum.create') }}'">Create Curriculum</button>
    <button class="tab-btn active" onclick="window.location.href='{{ route('curriculum.index') }}'">Curriculum List</button>
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
    .details strong  { color: black }
    .details p { color: var(--secondary-color) !important; margin: 0; }
    .list-item { padding: .4rem !important; }
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

    <!-- Curriculum List -->
    <div class="list-container">
        @forelse($curriculums as $curriculum)
            <div class="list-item mb-3 p-3 border rounded" onclick="this.classList.toggle('active')">
                <div class="question-header">
                    <span><strong>{{ $curriculum->title }}</strong></span>
                    <i class="fas fa-chevron-down"></i>
                </div>

                <div class="details mt-2" style="display: none;">
                    <p><strong>Competition:</strong> {{ $curriculum->competition->main_name }}</p>
                    <p><strong>Side Category:</strong> {{ $curriculum->sideCategory->name }}</p>
                    <p><strong>Read Category:</strong> {{ $curriculum->readCategory->name }}</p>
                    <p><strong>Age Category:</strong> {{ $curriculum->ageCategory->name }}</p>
                    <p><strong>Number of Questions:</strong> {{ $curriculum->number_of_questions }}</p>
                    <p><strong>Total Ayah:</strong> {{ $curriculum->total_ayah }}</p>
                    <p><strong>Remarks:</strong> {{ $curriculum->remarks ?? 'N/A' }}</p>
                    <div class="button-group-inline mt-3">
                        <a href="{{ route('curriculum.edit', $curriculum->id) }}" class="btn btn-edit btn-warning">Edit</a>
                        <form action="{{ route('curriculum.destroy', $curriculum->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete btn-danger" onclick="return confirm('Are you sure you want to delete this curriculum?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>No curriculums found.</p>
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
