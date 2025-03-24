





<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Read Category</title>
  <link rel="stylesheet" href="css/CreateReadCategory.css">
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
    }


    /* Container */
    .container {
      flex-grow: 1;
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
      padding: 10px;
      text-align: center;
    }




    /* Form Container */
    .form-container {
      background-color: var(--primary-color);
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin-bottom: 30px;
      text-align: left;
    }

    .read-category-form {
      margin-top: 10px;
    }

    .read-category-form input {
      width: 100%;
      padding: 12px;
      font-size: 14px;
      border: 1px solid #ddd;
      border-radius: 10px;
      outline: none;
      transition: border-color 0.3s ease-in-out;
      margin-bottom: 15px;
    }

    .read-category-form input:focus {
      border-color: var(--secondary-color);;
    }

    .read-category-form .save-btn {
      display: block;
      width: 100%;
      background-color: var(--secondary-color);;
      color: var(--primary-color);
      padding: 12px;
      font-size: 16px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
    }

    .read-category-form .save-btn:hover {
      background-color: #008f79;
    }

  </style>
</head>
<body>





    <header class="header">
        <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a>
        <h1>Create Read Category</h1>
    </header>

      <div class="container1">
  <div class="tabs">
    <button class="tab-btn "  onclick="window.location.href='{{ route('readcategory.create') }}'">Create Read Category</button>
    <button class="tab-btn " onclick="window.location.href='{{ route('readcategory.list') }}'">Read Category  List</button>
  </div>
      </div>










  <!-- Container for the main content -->
  <div class="container">


    <!-- Form Section -->
    <div class="form-container">
      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif



      <form class="read-category-form" method="POST" action="{{ route('readcategory.update') }}">
        @csrf
        <input type="text" name="name" placeholder="Read Category Name" required  value="{{ $readCategory->name }}">
        <button type="submit" class="btn save-btn">Save</button>
      </form>
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
.container {
  flex-grow: 1; /* Allow the content to expand and fill available space */
  margin-bottom: 140px; /* Add space at the bottom for footer */
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

</body>
</html>


