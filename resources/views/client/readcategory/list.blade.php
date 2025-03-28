<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Read Category List</title>
  <style>
    /* Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Body Styling */
     body {
position:relative;

        background-color: #f9f9f9;
        min-height: 60vw;
        display: flex;
        flex-direction: column;
        padding: 10px;
    }


    /* Main Content Area */
    .content {
        margin-top: 30px; /* Space for fixed header */
        flex: 1;
        width: 100%;
        max-width: 1200px;
        margin: 40px auto 50px; /* Center the content */
    }

    /* Tabs Styling */


    /* List Container */
    .list-container {
        background-color: var(--primary-color);
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 20px;
        max-height: 400px;
        overflow-y: auto;
    }

    .list-title {
        background-color: var(--secondary-color);;
        color: var(--primary-color);
        padding: 10px;
        text-align: center;
        border-radius: 10px;
        margin-bottom: 15px;
        font-size: 16px;
    }
/* Category Cards */
.category-card {
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 10px;
  margin-bottom: 10px;
  padding: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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

/* Dropdown functionality: toggle arrow rotation */
.card-header.open i {
  transform: translateY(-50%) rotate(180deg); /* Rotate the arrow when dropdown is open */
}

/* Action buttons styling */
.delete-btn, .edit-btn {
  border-radius: 13px; /* Rounded corners */
  padding: 10px 20px;
  font-size: 14px;
  font-weight: bold;
  text-align: center;
  cursor: pointer;
  transition: all 0.3s ease;
  border: none;
  width: 140px; /* Fixed width for uniformity */
}

.delete-btn {
  background-color: #e74c3c; /* Red background for delete */
  color: white;
}

.edit-btn {
  background-color: #2ecc71; /* Green background for edit */
  color: white;
}

.delete-btn:hover {
  background-color: #c0392b; /* Darker red on hover */
}

.edit-btn:hover {
  background-color: #27ae60; /* Darker green on hover */
}

/* Dropdown Arrow */
/* .card-header i {
    transition: transform 0.3s ease;
}

.card-header.open i {
    transform: rotate(180deg); /* Rotate the arrow when open */
 */



  </style>
</head>
<body>
  <!-- Header -->
  <header class="header">
    <a class="back-btn" href="{{ route('client.menu.quran') }}"><i class="fas fa-home"></i></a>
    <h1>Read Category List</h1>
  </header>

  <div class="container1">
    <div class="tabs">
      <button class="tab-btn" onclick="window.location.href='{{ route('readcategory.create') }}'">Create Read Category</button>
      <button class="tab-btn active" onclick="window.location.href='{{ route('readcategory.list') }}'">Read Category List</button>
    </div>
  </div>

  <!-- Main Content Area -->
  <div class="content">
    <div class="list-container">
      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      {{-- <h2 class="list-title">Read Category List</h2> --}}
      @foreach($readCategories as $readCategory)
        <div class="category-card">
          <div class="card-header" onclick="toggleDropdown(this)">


            <p>Read Category: <span>{{ $readCategory->name }} <i class="fas fa-chevron-down"></i></span></p>
          </div>
          <div class="card-actions">

            <form action="{{ route('readcategory.delete') }}" method="POST" style="display:inline-block;">
              @csrf
              <input type="hidden" name="read_category_id" value="{{ $readCategory->id }}">
              <button type="submit" class="btn delete-btn">Delete</button>
            </form>
            <form action="{{ route('readcategory.setSession') }}" method="POST" style="display:inline-block;">
                @csrf
                <input type="hidden" name="read_category_id" value="{{ $readCategory->id }}">
                <button type="submit" class="btn edit-btn">Edit</button>
              </form>
          </div>
        </div>
      @endforeach

      @if($readCategories->isEmpty())
        <p>No read categories found. Click "Create Read Category" to add one.</p>
      @endif
    </div>
  </div>

  <style>
    /* Body Styling */
body {

  background-color: #f9f9f9;
  display: flex;
  flex-direction: column;
  min-height: 100vh; /* Ensure body takes full height of the screen */
  padding: 0; /* Remove default padding */
}

/* Container Styling */
.content {
  flex-grow: 1; /* Allow the content to expand and fill available space */
  padding-bottom: 65px; /* Add space at the bottom for footer */
}

/* Footer Styling */
footer {
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  /* background-color: #f1f1f1; Footer background color */
  padding: 10px;
  text-align: center;
  margin-bottom: 10px; /* Margin above the footer */
}

  </style>
  @include('includes.footer')


<script>
  // Toggle the dropdown visibility of the Edit/Delete buttons and rotate the arrow
// Toggle the dropdown visibility of the Edit/Delete buttons and rotate the arrow
function toggleDropdown(element) {
    var actions = element.nextElementSibling; // Get the .card-actions div
    var icon = element.querySelector('i'); // Get the icon for the arrow

    // Toggle visibility of buttons
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
