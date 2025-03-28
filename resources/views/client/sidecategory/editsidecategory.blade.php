<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Side Category</title>
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
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      min-height: 60vw;
      padding: 0;
    }

    /* Header */
    header {
      display: flex;
      justify-content: center; /* Center header title */
      align-items: center;
      background-color: var(--secondary-color);;
      color: var(--primary-color);
      padding: 10px;
      font-size: 18px;
    }

    /* Main Content */
    .container {
      flex-grow: 1;
      padding: 20px;
      text-align: center;
    }

    .container h1 {
      margin-bottom: 20px;
      font-size: 24px;
    }

    form {
      display: flex;
      flex-direction: column; /* Stack form elements vertically */
      align-items: center; /* Center form elements */
    }

    label {
      font-size: 16px;
      display: block;
      margin-bottom: 10px;
      text-align: left;
      width: 100%;
      max-width: 300px;
    }

    input {
      font-size: 14px;
      padding: 10px;
      width: 100%;
      max-width: 300px;
      border: 1px solid #ddd;
      border-radius: 8px;
      margin-bottom: 20px;
    }

    button {
      background-color: var(--secondary-color);;
      color: var(--primary-color);
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease-in-out;
      width: 100%; /* Make the button take full width */
      max-width: 300px;
    }

    button:hover {
      background-color: #008f79;
    }

    /* Footer */
    footer {
      background-color: var(--secondary-color);;
      color: var(--primary-color);
      padding: 15px;
      text-align: center;
    }
    .container {
      flex-grow: 1; /* Make the container take up the available space between header and footer */
      width: 100%;
      max-width: 100%; /* Full width for container */
      text-align: center;
      margin: 0 auto; /* Center the container horizontally */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
border-radius: 1rem;
border: 1px solid  var(--secondary-color);;
    }


  </style>
</head>
<body>
  <!-- Header -->

  <header class="header">
    <a class="back-btn" href="{{ route('client.menu.quran') }}"><i class="fas fa-home"></i></a>
    <h1>Edit Side Category</h1>
  </header>

  <div class="container1">
<div class="tabs">
<button class="tab-btn " onclick="window.location.href='{{ route('sidecategory.create') }}'">Create Side Category</button>
<button class="tab-btn " onclick="window.location.href='{{ route('sidecategory.list') }}'">Side Category List</button>
</div>
  </div>


  <!-- Main Content -->
  <div class="container">
    <form method="POST" action="{{ route('sidecategory.update') }}">
      @csrf
      <label for="name">Category Name</label>
      <input type="text" name="name" id="name" value="{{ $sideCategory->name }}" required>
      <button type="submit">Update</button>
    </form>
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
.container {
  flex-grow: 1; /* Allow the content to expand and fill available space */
  margin-bottom: 160px; /* Add space at the bottom for footer */
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
  {{-- @include('includes.footer') --}}
  @include('includes.footer')

</body>
</html>
