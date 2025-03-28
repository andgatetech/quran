<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Age Category List</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="css/AgeCategoryList.css">
  <style>

    /* Main Content Styling */
    .main-content {
      flex-grow: 1;
      width: 100%;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      overflow-y: auto;
    }


    /* Age Category List Container */
    /* Scrollable container for the list */
/* Scrollable container for the list */
.list-container {
  width: 100%;
  background-color: #fff;
  max-height: 400px; /* Set a fixed height for the scrollable area */
  overflow-y: auto; /* Enable vertical scrolling */
  scrollbar-width: thin; /* For Firefox */
  scrollbar-color: #008f79 #f1f1f1; /* Green scrollbar */
}

.list-container::-webkit-scrollbar {
  width: 8px; /* Set the width of the scrollbar */
}

.list-container::-webkit-scrollbar-track {
  background: #f1f1f1; /* Background for the scrollbar track */
}

.list-container::-webkit-scrollbar-thumb {
  background: #008f79; /* Green color for the scrollbar thumb */
  border-radius: 10px; /* Rounded corners for the thumb */
}

/* Category Cards */
.category-card {
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
  padding: 15px;
  text-align: left;
  width: 100%;
  border: 1px solid #ddd;
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


/* Action buttons (Edit and Delete) */
.card-actions {
  display: none; /* Hide by default */
  justify-content: center;
  margin-top: 10px;
  text-align: center;
  display: flex;
  justify-content: space-around;
  align-items: center;
}

.card-actions .btn {
  background-color: var(--secondary-color);
  color: var(--primary-color);
  padding: 10px 20px;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  transition: background-color 0.3s ease-in-out;
  width: 120px;
}

.card-actions .btn:hover {
  background-color: #008f79;
}

/* Danger Button (Delete) */
.card-actions .btn.delete-btn {
  background-color: #e74c3c;
  color: var(--primary-color);
}

.card-actions .btn.delete-btn:hover {
  background-color: #c0392b;
}

/* Show dropdown and action buttons when open */
.card-header.open + .card-actions {
  display: flex;
}

/* Content and layout styling */
.content {
  margin-top: 30px; /* Space for fixed header */
  flex: 1;
  width: 100%;
  max-width: 1200px;
  margin: 40px auto 50px; /* Center the content */
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

.category-card {
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 10px;
  margin-bottom: 10px;
  padding: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

  </style>
</head>
<body>
    <header class="header">
        <a class="back-btn" href="{{ route('client.menu.quran') }}"><i class="fas fa-home"></i></a>
        <h1>Create Age Category</h1>
      </header>

        <div class="tabs">
        <button class="tab-btn "  onclick="window.location.href='{{ route('agecategory.create') }}'">Create Age Category</button>
        <button class="tab-btn active" onclick="window.location.href='{{ route('agecategory.index') }}'">Age Category List</button>
        </div>

  <div class="container">
    <!-- Header -->

    <!-- Main Content -->
    <div class="main-content">
      <!-- Tabs -->


      <!-- Age Category List -->
      <div class="content">
        <div class="list-container">
          {{-- <h2 class="list-title">Age Category List</h2> --}}

          @foreach ($ageCategories as $ageCategory)
            <div class="category-card">
              <div class="card-header" onclick="toggleDropdown(this)">
                <p>Age Category: <span>{{ $ageCategory->name }}</span></p>
                <i class="fas fa-chevron-down"></i>
              </div>
              <div class="card-actions">
                <form action="{{ route('agecategory.delete', $ageCategory->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    <button type="submit" class="btn delete-btn">Delete</button>
                  </form>
                <form action="{{ route('agecategory.setSession') }}" method="POST" style="display:inline-block;">
                  @csrf
                  <input type="hidden" name="age_category_id" value="{{ $ageCategory->id }}">
                  <button type="submit" class="btn edit-btn">Edit</button>
                </form>

              </div>
            </div>
          @endforeach

          @if ($ageCategories->isEmpty())
            <p>No age categories found. Click "Create Age Category" to add one.</p>
          @endif
        </div>
      </div>
    </div>
  </div>

  @include('includes.footer')

  <script>
    // Function to toggle dropdown and rotate arrow
    function toggleDropdown(element) {
      var actions = element.nextElementSibling; // Get the .card-actions div
      var icon = element.querySelector('i'); // Get the icon for the arrow

      // Toggle visibility of buttons and arrow rotation
      if (actions.style.display === "none" || actions.style.display === "") {
        actions.style.display = "flex"; // Show the buttons
        element.classList.add('open'); // Add class to rotate the arrow
      } else {
        actions.style.display = "none"; // Hide the buttons
        element.classList.remove('open'); // Remove class to rotate the arrow back
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
