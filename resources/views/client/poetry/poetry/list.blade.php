@extends('layouts.app')

@section('content')
<header class="header">
    <a class="back-btn" href="{{ route('client.menu.poetry') }}"><i class="fas fa-home"></i></a>
    <h1> Poetry List(Poetry)</h1>
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
<button class="tab-btn "  onclick="window.location.href='{{ route('poetry.poetry.create') }}'">Create Poetry</button>
<button class="tab-btn active" onclick="window.location.href='{{ route('poetry.poetry.index') }}'">Poetry List</button>
</div>

<form action="{{ route('poetry.poetry.index') }}" method="get">
            <div class="row">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                
                
                <div class="col-6">
                    <select class="form-select" name="age_category" id="age_category">
                        <option value="">Age Category</option>
                        @foreach ($age_categories as $age_category)
                            <option {{ request()->age_category == $age_category->id ? 'Selected' : '' }}
                                value="{{ $age_category->id }}">{{ $age_category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6">
                    <select class="form-select" name="side_category" id="side_category">
                        <option value="">Perform Option</option>
                        @foreach ($side_categories as $side_category)
                            <option {{ request()->side_category == $side_category->id ? 'Selected' : '' }}
                                value="{{ $side_category->id }}">{{ $side_category->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="row my-3">
                
                <div class="col-6">
                    <select class="form-select" name="read_category" id="read_category">
                        <option value="">Method of Perform</option>
                        @foreach ($read_categories as $read_category)
                            <option {{ request()->read_category == $read_category->id ? 'Selected' : '' }}
                                value="{{ $read_category->id }}">{{ $read_category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6">
                        
                    <input style="width:200px;" type="submit" value="Search" class="tab-btn active">
                        
                </div>

            </div>
            
        </form>


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
                    <span><strong>{{ $competitor->poetry_name }}</strong></span>
                    <i class="fas fa-chevron-down"></i>
                </div>
        
                    <div class="details mt-2" style="display: none; box-shadow:0 !important;">
                    <p><strong>Poetry Name:</strong> {{ $competitor->poetry_name }}</p>
                    <p><strong>Competition Name:</strong> {{ $competitor->competition->main_name ?? 'N/A' }}</p>
                    <p><strong>Perform Option:</strong> {{ $competitor->sideCategory->name ?? 'N/A' }}</p>
                    <p><strong>Method Of Perform:</strong> {{ $competitor->readCategory->name ?? 'N/A' }}</p>
                    <p><strong>Age Category:</strong> {{ $competitor->ageCategory->name ?? 'N/A' }}</p>
                    <p><strong>Number of Questions:</strong> {{ $competitor->number_of_questions }}</p>
                    <div class="button-group-inline mt-3">
                        <a href="{{ route('poetry.poetry.edit', $competitor->id) }}" class="btn btn-edit btn-warning">Edit</a>
                        <form action="{{ route('poetry.poetry.destroy', $competitor->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete btn-danger" onclick="return confirm('Are you sure you want to delete this competitor?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>No Poetry found.</p>
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
