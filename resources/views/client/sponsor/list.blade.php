@extends('layouts.app')

@section('content')
    <style>
        .question-header.open i {
            transform: translateY(-50%) rotate(180deg);
            /* Rotate the arrow when dropdown is open */
        }

        .question-header i {
            color: #888;
            cursor: pointer;
            position: absolute;
            /* Position the arrow in the top-right corner */
            right: 10px;
            /* Distance from the right edge */
            top: 50%;
            /* Center vertically */
            transform: translateY(-50%);
            /* Adjust vertical positioning to center the arrow */
            transition: transform 0.3s ease;
            /* Smooth rotation transition */
        }

        .list-item.active .question-header i {
            transform: rotate(180deg);
            /* Rotates the arrow icon */
            transition: transform 0.3s ease-in-out;
        }




        .question-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .question-header p {
            font-size: 16px;
            color: #333;
            margin: 0;
        }

        .question-header span {
            color: var(--secondary-color);
            font-weight: bold;
        }


        .list-container {
            box-shadow: none !important;
            height: 100% !important;
        }

        .button-group-inline{
            display: flex;
            gap: .5rem;
            align-items: center;
            justify-content: space-around;
        }
    </style>

    <header class="header">
        <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a>
        <h1> Sponsor List</h1>
    </header>

    <div class="tabs">

        <button class="tab-btn " onclick="window.location.href='{{ route('sponsors.create') }}'">Create Sponsor</button>
        <button class="tab-btn active" onclick="window.location.href='{{ route('sponsors.index') }}'">Sponsor
            List
        </button>
    </div>

    <div class="container">







        <div class="list-container">
            {{-- <div class="list-header">Competitor List</div> --}}
            @forelse($sponsors as $sponsor)
                @if($sponsor->status == 'Enable')  <!-- Exclude if status is 'Disable' -->
                    <div class="list-item mb-3 p-3 border rounded" onclick="toggleDetails(event, this)">
                        <div class="question-header">
                            <p>Sponsor Name: <span>{{ $sponsor->name }} <i class="fas fa-chevron-down"></i></span></p>
                        </div>
        
                        <div class="details mt-2" style="display: none;">
                            <p><strong>Tin# / ID:</strong> {{ $sponsor->Tin ?? 'N/A' }}</p>
                            <p><strong>Details:</strong> {{ $sponsor->Details ?? 'N/A' }}</p>
                            <p><strong>Status:</strong> {{ $sponsor->status }}</p>
        
                            <div class="button-group-inline mt-3">
                                <form action="{{ route('sponsors.destroy', $sponsor->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete btn-danger" onclick="return confirm('Are you sure you want to delete this sponsor?')">Delete</button>
                                </form>
                                <a href="{{ route('sponsors.edit', $sponsor->id) }}" class="btn btn-edit btn-primary">Edit</a>
                                <a href="{{ route('sponsors.show', $sponsor->id) }}" class="btn btn-view btn-info">Photo</a>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <p>No sponsors found.</p>
            @endforelse
        </div>
        
    </div>
        <!-- JavaScript to toggle details -->
        <script>
            function toggleDetails(event, element) {
                // Prevent toggling when clicking on buttons or links
                if (event.target.tagName.toLowerCase() !== 'button' && event.target.tagName.toLowerCase() !== 'a') {
                    const details = element.querySelector('.details');
                    const isActive = element.classList.toggle('active');
                    details.style.display = isActive ? 'block' : 'none';
                }
            }
        </script>
    @endsection
