<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Competition List</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="css/CompetitionList.css">
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
       .btn:hover {

        border: 1px solid var(--secondary-color) !important;
      background-color: var(--primary-color) !important;
      color: var(--secondary-color) !important;

    }


    .competition-list {

      border-radius: 10px;
    }

    .list-heading {
      background-color: var(--secondary-color);
      color: var(--primary-color);
      padding: 10px;
      text-align: center;
      border-radius: 10px;
      font-size: 14px;
    }

    .competitions-container {
      margin-top: 20px;
      max-height: 60rem;
      min-height: 10rem;
      overflow-y: auto; /* Enable vertical scrollbar when content overflows */
    }

    /* Competition Cards */
    .competition-card {
      background: white;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .competition-main-name p,
    .competition-sub-name p {
      font-size: 13px;
      margin-bottom: 5px;
      cursor: pointer; /* Add cursor pointer to indicate it is clickable */
    }

    .competition-main-name span,
    .competition-sub-name span {
      color: var(--secondary-color);
    }

    .competition-main-name i {
      float: right;
      color: #888;
    }

    /* Hide Sub Name and Buttons by Default */
    .competition-sub-name,
    .card-buttons {
      display: none;
    }

    /* Show Buttons and Sub Name when Active */
    .competition-main-name.active + .competition-sub-name,
    .competition-main-name.active + .competition-sub-name + .card-buttons {
      display: block;
    }





  </style>
</head>
<body>

  <header class="header">
    <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a>
    <h1>Competition List</h1>
  </header>

  <div class="container1">
    <div class="tabs">

      <button class="tab-btn" onclick="window.location.href='{{ route('competition.create') }}'">Create Competition</button>
      <button class="tab-btn active" onclick="window.location.href='{{ route('competition.list') }}'">Competition List</button>
    </div>
  </div>

  <div class="container">
    <!-- Competition List -->
    <div class="competition-list">
      {{-- <h2 class="list-heading">Competitions List</h2> --}}

      <!-- Main Container for all Competitions -->
      <div class="competitions-container">
        @foreach($competitions as $competition)
          <div class="competition-card">
            <!-- Main Name with Dropdown Toggle -->
            <div class="competition-main-name" onclick="toggleDropdown(this)">
              <p>Competition Main Name: <span>{{ $competition->main_name }}</span>
                <i class="fas fa-chevron-down"></i>
              </p>
            </div>
            <!-- Sub Name, initially hidden -->
            <div class="competition-sub-name">
              <p>Competition Sub Name: <span>{{ $competition->sub_name }}</span></p>
            </div>
            <!-- Buttons -->
            <div class="card-buttons">
              <form action="{{ route('competition.delete', $competition->id) }}" method="POST" style="display:inline-block;">
                @csrf
                <button type="submit" class="btn delete-btn">Delete</button>
              </form>
              <form action="{{ route('competition.setSession') }}" method="POST" style="display:inline-block;">
                @csrf
                <input type="hidden" name="competition_id" value="{{ $competition->id }}">
                <button type="submit" class="btn edit-btn">Edit</button>
              </form>
            </div>
          </div>
        @endforeach

        @if($competitions->isEmpty())
          <p>No competitions found. Click "Create Competition" to add one.</p>
        @endif
      </div>
    </div>
  </div>

  @include('includes.footer')

  <script>
    // JavaScript to toggle dropdown and change arrow direction
    function toggleDropdown(element) {
      var subName = element.nextElementSibling; // Get the sub-name div
      var icon = element.querySelector('i'); // Get the arrow icon
      var buttons = subName.nextElementSibling; // Get the button div

      // Toggle visibility of sub-name and buttons
      if (subName.style.display === "none" || subName.style.display === "") {
        subName.style.display = "block"; // Show the sub-name
        buttons.style.display = "flex"; // Show the buttons
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
      } else {
        subName.style.display = "none"; // Hide the sub-name
        buttons.style.display = "none"; // Hide the buttons
        icon.classList.remove('fa-chevron-up');
        icon.classList.add('fa-chevron-down');
      }
    }

    // Ensure all dropdowns are closed on page load
    window.onload = function() {
      var allSubNames = document.querySelectorAll('.competition-sub-name');
      var allButtons = document.querySelectorAll('.card-buttons');
      allSubNames.forEach(function(subName) {
        subName.style.display = "none";
      });
      allButtons.forEach(function(button) {
        button.style.display = "none";
      });
    }
  </script>
</body>
</html>
