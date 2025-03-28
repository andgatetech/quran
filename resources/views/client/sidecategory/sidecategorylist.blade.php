<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Side Category List</title>
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

.card-actions {
  display: none; /* Hide by default */
  justify-content: center;
  margin-top: 10px;
  text-align: center;
  display: flex;
  justify-content: space-around;
  align-items: center;
}

  /* Category Card Buttons */
.delete-btn, .edit-btn {
  border-radius: 10px; /* Rounded corners */
  padding: 10px 20px; /* Adjust padding for better button size */
  font-size: 14px; /* Set font size */
  font-weight: bold; /* Make text bold */
  text-align: center;
  cursor: pointer;
  transition: all 0.3s ease;
  border: none;
  width: 100px; /* Fixed width for uniformity */
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

  </style>
</head>
<body>

  <header class="header">
    <a class="back-btn" href="{{ route('client.menu.quran') }}"><i class="fas fa-home"></i></a>
    <h1>Side Category List</h1>
  </header>

    <div class="tabs">
      <button class="tab-btn" onclick="window.location.href='{{ route('sidecategory.create') }}'">Create Side Category</button>
      <button class="tab-btn active" onclick="window.location.href='{{ route('sidecategory.list') }}'">Side Category List</button>
    </div>

  {{-- <div class="main-content"> --}}
    <div class="container">
      <div class="list-container">
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- <h2 class="list-title">Side Category List</h2> --}}

        @foreach($sideCategories as $sideCategory)
          <div class="category-card">
            <div class="card-header" onclick="toggleDropdown(this)">
              <p>Side Category: <span>{{ $sideCategory->name }}</span> <i class="fas fa-chevron-down"></i></p>
            </div>
            <div class="card-actions">

              <form action="{{ route('sidecategory.delete') }}" method="POST" style="display:inline-block;">
                @csrf
                <input type="hidden" name="side_category_id" value="{{ $sideCategory->id }}">
                <button type="submit" class="btn delete-btn">Delete</button>
              </form>
              <form action="{{ route('sidecategory.setSession') }}" method="POST" style="display:inline-block;">
                @csrf
                <input type="hidden" name="side_category_id" value="{{ $sideCategory->id }}">
                <button type="submit" class="btn edit-btn">Edit</button>
              </form>
            </div>
          </div>
        @endforeach

        @if($sideCategories->isEmpty())
          <p>No side categories found. Click "Create Side Category" to add one.</p>
        @endif
      </div>
    </div>
  {{-- </div> --}}
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
.container {
  flex-grow: 1; /* Allow the content to expand and fill available space */
  padding-bottom: 200px; /* Add space at the bottom for footer */
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
