<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recitation Piece List</title>
  <link rel="stylesheet" href="css/SideCategoryList.css">
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> --}}
  <style>
    /* Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Body Styling */
    body {
      position: relative;

      background-color: #f9f9f9;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      padding: 0;
    }

    /* Header Styling */
    .header {
      width: 100%;
      background-color: var(--secondary-color);
      color: var(--primary-color);
      padding: 15px 20px;
      border-radius: 0 0 10px 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
    }

    .header h1 {
      flex-grow: 1;
      font-size: 18px;
      text-align: center;
    }

    .back-btn {
      background: none;
      border: none;
      color: var(--primary-color);
      font-size: 18px;
      cursor: pointer;
    }

    /* Main Content */
    .main-content {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      padding: 20px;
    }

    /* Container */
    .container {
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
    }

    /* List Container */
    .list-container {
      background-color: var(--primary-color);
      border-radius: 10px;
      /* box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); */
      padding: 1rem .5rem;
      max-height: 50rem;
      overflow-y: auto;
    }

    .list-title {
      background-color: var(--secondary-color);
      color: var(--primary-color);
      padding: 10px;
      text-align: center;
      border-radius: 10px;
      margin-bottom: 15px;
      font-size: 16px;
    }

    /* Category Cards */
    .category-card {
      background: white;
      margin: 10px auto;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      width: 40rem;
    }

    .card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
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

.card-actions {
  display: none; /* Hide by default */
  justify-content: center;
  margin-top: 10px;
  text-align: center;
  align-items: center;
}
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


  </style>
</head>
<body>

<!-- top bar -->
@include('client.layouts.top-bar')

    <div class="tabs">
    <button class="tab-btn" onclick="window.location.href='{{ route('quran.recitation.piece.create') }}'">Create Recitation Piece</button>
    <button class="tab-btn active" onclick="window.location.href='{{ route('quran.recitation.piece.list') }}'">Recitation Piece List</button>
    </div>

    <div class="container">
      <div class="row">
      <div class="col-md-6 col-sm-12 offset-md-3">
      <div class="list-container">
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- <h2 class="list-title">Side Category List</h2> --}}

        @foreach($recitationPieces as $recitationPiece)
          <div class="category-card">
            <div class="card-header" onclick="toggleDropdown(this)">
              <p>Recitation Piece: <span>{{ $recitationPiece->name }}</span> <i class="fas fa-chevron-down"></i></p>
            </div>
            <div class="card-actions">
              <form action="{{ route('quran.recitation.piece.delete', $recitationPiece->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn delete-btn">Delete</button>
              </form>
                <a href="{{ route('quran.recitation.piece.edit',$recitationPiece->id) }}" class="btn edit-btn">Edit</a>
            </div>
          </div>
        @endforeach

        @if($recitationPieces->isEmpty())
          <p>No side categories found. Click "Create Side Category" to add one.</p>
        @endif
      </div>
      </div>

      </div>
    
    </div>

  @include('includes.footer')

  <script>
    function toggleDropdown(element) {
      const actions = element.nextElementSibling; // Get the .card-actions div
      const icon = element.querySelector('i'); // Get the icon for the arrow

      // Toggle visibility of buttons
      if (actions.style.display === "none" || actions.style.display === "") {
        actions.style.display = "flex"; // Show the buttons
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
      } else {
        actions.style.display = "none"; // Hide the buttons
        icon.classList.remove('fa-chevron-up');
        icon.classList.add('fa-chevron-down');
      }
    }

    // Ensure all dropdowns are closed on page load
    window.onload = function() {
      var allActions = document.querySelectorAll('.card-actions');
      allActions.forEach(function(actions) {
        actions.style.display = "none"; // Hide actions by default
      });
    }
  </script>

</body>
</html>
