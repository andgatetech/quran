@extends('layouts.app')

@section('content')


    <header class="header">
        <a class="back-btn" href="{{ route('client.menu.quran') }}"><i class="fas fa-home"></i></a>
        <h1>Judge List</h1>
      </header>


        <div class="tabs">
            <button class="tab-btn" onclick="window.location.href='{{ route('judges.create') }}'">Create Judge</button>
            <button class="tab-btn active" onclick="window.location.href='{{ route('judges.index') }}'">Judge List</button>
        </div>

    <div class="content">
        <div class="list-container">
            @if (session('success'))
                <div class="alert alert-success alert-custom animate__animated animate__fadeInDown" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-custom animate__animated animate__fadeInDown" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            {{-- <div class="list-header">Judge List</div> --}}

            @forelse($judges as $judge)
                <div class="category-card">
                    <div class="card-header" onclick="toggleDetails(this)">
                        <p>{{ $judge->full_name }} <span>({{ $judge->id_card_number }})</span> <i
                                class="fas fa-chevron-down"></i></p>
                    </div>
                    <div class="details">
                        <p>Name of the Judge: <span>{{ $judge->full_name }}</span></p>
                        <p>ID Card Number: <span>{{ $judge->id_card_number }}</span></p>
                        <p>Address: <span>{{ $judge->address }}</span></p>
                        <p>Island / City: <span>{{ $judge->island_city }}</span></p>
                        <p>Work Office: <span>{{ $judge->work_office }}</span></p>
                        <p>Phone Number: <span>{{ $judge->phone_number }}</span></p>
                        <p>Competition Name: <span>{{ $judge->competition_id }}</span></p>
                        <p>Point Categories: <span>{{ $judge->pointCategory_id ?? 'Default' }}</span></p>
                        <p>Bell Option: <span>{{ $judge->bell_option }}</span></p>
                        <p>Email Address: <span>{{ $judge->email }}</span></p>
                        <p>Password: <span>************</span></p>
                        <div class="button-group-inline">
                            <form action="{{ route('judges.destroy', $judge->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn delete-btn">Delete</button>
                            </form>
                            <a href="{{ route('judges.edit', $judge->id) }}" class="btn edit-btn">Edit</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>No judges found.</p>
            @endforelse
        </div>
    </div>

    <script>
        function toggleDetails(element) {
            const details = element.nextElementSibling;
            const icon = element.querySelector('i');

            if (details.style.display === 'none' || !details.style.display) {
                details.style.display = 'block';
                icon.style.transform = 'rotate(180deg)';
            } else {
                details.style.display = 'none';
                icon.style.transform = 'rotate(0deg)';
            }
        }

        window.onload = function() {
            const details = document.querySelectorAll('.details');
            details.forEach((detail) => (detail.style.display = 'none'));
        };
    </script>
    <style>
        .header {
          display: flex;
          align-items: center;
          background-color: var(--secondary-color);
          color: var(--primary-color);
          padding: 15px 20px;
          border-radius: 10px;
          box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
          position: sticky;
          top: 0;
          z-index: 100;
          width: 100%;
        }

        .header h1 {
          flex-grow: 1;
          font-size: 18px;
          text-align: center;
        }
        .back-btn {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: white;
        }

        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .tab-btn {
            font-size: 14px;
            padding: 10px 20px;
            border-radius: 20px;
            background-color: var(--primary-color);
            color: var(--secondary-color);
            border: 2px solid var(--secondary-color);
            margin: 0 10px;
        }

        .tab-btn.active {
            background-color: var(--secondary-color);
            color: var(--primary-color);
        }

        .content {
            width: 90%;
            margin: 20px auto;
        }

        .list-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            min-height: 30rem;
            max-height: 50rem;
            margin-bottom: 6rem !important;

        }

        .list-header {
            background-color: var(--secondary-color);
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .category-card {
            /* background: white; */
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0;margin: 0;
  background-color: #fff;

}

.card-header p {
  font-size: 14px;
  display: flex;
  justify-content: space-between;
  width: 100%; /* Ensures the text spans the width */
}

.card-header span {
  color: var(--secondary-color);
  font-weight: bold;
  margin-left: auto; /* Pushes span to the right */
}

.card-header i {
  color: #888;
  cursor: pointer;
  margin-left: 8px; /* Add some spacing between the text and the icon */
}
        .details {
            display: none;
            margin-top: 10px;
            font-size: 14px;
        }

        .details p {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }

        .details span {
            color: var(--secondary-color);
            font-weight: bold;
        }

        .button-group-inline {
            display: flex;
            justify-content: space-around;
            margin-top: 15px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
            cursor: pointer;
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        .edit-btn {
            background-color: #2ecc71;
            color: white;
        }

        .edit-btn:hover {
            background-color: #27ae60;
        }
    </style>
@endsection


